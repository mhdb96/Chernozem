<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Kit;
use App\Models\MyController;
use App\Models\Sensor;
use App\Models\Actuator;

class KitData{
    public $id;
    public $name;
    public $description;
    public $sensors = array();
    public $actuators = array();
    public $myController;
}

class KitController extends Controller
{
    private $route = 'kit';
    private $title = 'Kit';
    private $fillables = ['name','description','sensors','actuators','myController'];
    private $fillables_titles = ['Isim','Aciklama','Sensötler','Eyleyiciler','Kontroller'];
    private $fillables_types = ['text','text','many','many','one'];

    public function __construct()
    {
        $this->middleware('admin')->except('show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kits = Kit::all();

        $data = array();
        foreach($kits as $item){
            $d = new KitData();
            $d->id = $item->id;
            $d->name = $item->name;
            $d->description = $item->description;
            $d->myController = $item->myController->name;

            $sensor_array = array();
            $actuators_array = array();
            foreach($item->sensors as $sensor){
                array_push($sensor_array, $sensor->name);
            }
            foreach($item->actuators as $actuator){
                array_push($actuators_array, $actuator->name);

            }
            //array_push($d->soil,$array);
            $d->sensors = $sensor_array;
            $d->actuators = $actuators_array;

            array_push($data,$d);
        }

        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'empty_space' => 700,
            'data' => $data
        );
        return view($this->route.'.index')->with($my_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sensors = Sensor::all();
        $actuators = Actuator::all();
        $controllers = MyController::all();
        //dd($actuators);
        if(count($sensors) == 0)
            return redirect()->route('sensor.create');
        if(count($actuators) == 0)
            return redirect()->route('actuator.create');
        if(count($controllers) == 0)
            return redirect()->route('controller.create');
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['name','description', $sensors, $actuators, $controllers],
            'fillables_titles' => ['Isim','Aciklama','Sensorler', 'Eyleyiciler', 'Kontrolorler'],
            'fillables_types' => $this->fillables_types,
            'is_multiple' => false
        );        
        return view($this->route.'.create')->with($my_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kit = new Kit;
        $kit->name = $request->name;
        $kit->description = $request->description;
        $kit->myController()->associate($request->controllers);     
        $kit->save(); 
        $kit->sensors()->attach($request->sensors);
        $kit->actuators()->attach($request->actuators);                   
        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kit $kit, Request $request)
    {
        $projectAreaKit = DB::table('project_area_kit')->where([
            ['project_area_id', '=', $request->input('project_area_id')],
            ['kit_id', '=', $kit->id],
            ['mac_adress', '<>', null]
        ])->get()->first();

        if ($projectAreaKit == null)
            return redirect()->back()->with('warning', 'Bu kite şu anda ulaşılamıyor');
        else 
            $request->session()->put('mac_adress', $projectAreaKit->mac_adress);
        

        $actions = array();
        foreach ($kit->actuators as $actuator) {
            foreach ($actuator->actions as $action) {
                array_push($actions, $action);
            }            
        }

        $inputs = array();
        foreach ($kit->sensors as $sensors) {
            foreach ($sensors->inputs as $input) {
                array_push($inputs, $input);
            }            
        }

        $mac_adress = $request->session()->get('mac_adress');

        return view('input.list', compact('inputs', 'actions', 'kit', 'mac_adress'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kit $kit)
    {
        $sensors = Sensor::all();
        $actuators = Actuator::all();
        $controllers = MyController::all();
        $insertedSensorIds = array();
        $insertedActuatorIds = array();
        $insertedControllerIds = array();
                
        foreach ($kit->sensors as $sensor) {
            array_push($insertedSensorIds, $sensor->id);
        }
        foreach ($kit->actuators as $actuator) {
            array_push($insertedActuatorIds, $actuator->id);
        }
        
            array_push($insertedControllerIds, $kit->myController->id);

        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['name','description', [$sensors, $insertedSensorIds], [$actuators, $insertedActuatorIds], [$controllers, $insertedControllerIds]],
            'fillables_titles' => ['Isim','Aciklama','Sensorler','Eyleyiciler','Kontrolor'],  
            'fillables_types' => $this->fillables_types,          
            'data' => $kit
        );
        return view($this->route.'.edit')->with($my_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kit $kit)
    {
        //dd($request);
        $kit->name = $request->name;
        $kit->description = $request->description;
        $kit->myController()->associate($request->controllers);          
        $kit->save();
        $kit->sensors()->sync($request->sensors);
        $kit->actuators()->sync($request->actuators);
        return redirect()->route($this->route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isExist = DB::table('project_area_kit')->where('kit_id', $id)->exists();

        if($isExist)
        {
            return redirect('/'.$this->route)
            ->with('warning', 'Bu '.$this->title.' türü diğer tablolarla ilişki olduğu için silemezsiniz.');
        }       

            Kit::find($id)->sensors()->detach();
            Kit::find($id)->actuators()->detach();
            Kit::find($id)->delete();
            return redirect('/'.$this->route)
                ->with('success', $this->title.' silme işlemi başarılı bir şekilde gerçekleştirildi');

/*
        $kit->sensors()->detach();
        $kit->actuators()->detach();
        $kit->delete();
        return redirect()->route($this->route.'.index');
  */
    }
}
