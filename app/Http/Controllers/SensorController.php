<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\Input;

class SensorData{
    public $id;
    public $name;
    public $unit_price;
    public $description;
    public $inputs = array();
}

class SensorController extends Controller
{
    private $route = 'sensor';
    private $title = 'Sensor';
    private $fillables = ['name','description','unit_price','inputs'];
    private $fillables_titles = ['Isim','Aciklama','Fiyat','Girişler'];
    private $fillables_types = ['text','text','number','many'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sensors = Sensor::all();

        $data = array();
        foreach($sensors as $item){
            $d = new SensorData();
            $d->id = $item->id;
            $d->name = $item->name;
            $d->description = $item->description;
            $d->unit_price = $item->unit_price.'₺';

            $array = array();
            foreach($item->inputs as $input){
                array_push($array, $input->name);
            }
            $d->inputs = $array;

            array_push($data,$d);
        }

        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'empty_space' => 500,
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
        $inputs = Input::all();
        if(count($inputs) == 0)
            return redirect()->route('input.create');
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['name','description','unit_price', $inputs],
            'fillables_titles' => ['Isim','Aciklama','Fiyat', 'Girisler'],
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
        $sensor = new Sensor;
        $sensor->name = $request->name;
        $sensor->description = $request->description;
        $sensor->unit_price = $request->unit_price;
        $sensor->save();
        $sensor->inputs()->attach($request->inputs);
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
    public function edit(Sensor $sensor)
    {
        $inputs = input::all();
        $insertedInputIds = array();
        foreach ($sensor->inputs as $input) {
            array_push($insertedInputIds, $input->id);
        }
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['name','description','unit_price', [$inputs, $insertedInputIds]],
            'fillables_titles' => ['Isim','Aciklama','Fiyat', 'Girisler'],
            'fillables_types' => $this->fillables_types,
            'data' => $sensor
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
    public function update(Request $request, Sensor $sensor)
    {
        $sensor->name = $request->name;
        $sensor->description = $request->description;
        $sensor->unit_price = $request->unit_price;
        $sensor->save();
        $sensor->inputs()->sync($request->inputs);

        return redirect()->route($this->route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sensor $sensor)
    {
        $sensor->inputs()->detach();
        $sensor->delete();
        return redirect()->route($this->route.'.index')->with('success', $this->title.' silme işlemi başarılı bir şekilde gerçekleştirildi');
    }
}
