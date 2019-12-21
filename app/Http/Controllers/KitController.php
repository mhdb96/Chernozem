<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kit;
use App\Models\MyController;
use App\Models\Sensor;
use App\Models\Actuator;

class KitController extends Controller
{
    private $route = 'kit';
    private $title = 'Kit';
    private $fillables = ['name','description'];
    private $fillables_titles = ['Isim','Aciklama'];
    private $fillables_types = ['text','text','many','many','one'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kits = Kit::all();
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'empty_space' => 700,
            'data' => $kits
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
    public function show($id)
    {
        //
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
    public function destroy(Kit $kit)
    {
        $kit->sensors()->detach();
        $kit->actuators()->detach();
        $kit->delete();
        return redirect()->route($this->route.'.index');
    }
}
