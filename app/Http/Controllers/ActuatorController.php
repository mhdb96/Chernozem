<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actuator;
use App\Models\Action;


class ActuatorData{
    public $id;
    public $name;
    public $unit_price;
    public $description;
    public $actions = array();
}

class ActuatorController extends Controller
{
    private $route = 'actuator';
    private $title = 'Eyleyici';
    private $fillables = ['name','description','unit_price','actions'];
    private $fillables_titles = ['İsim','Açıklama','Fiyat','Eylemler'];
    private $fillables_types = ['text','text','number','many'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actuators = Actuator::all();

        $data = array();
        foreach($actuators as $item){
            $d = new ActuatorData();
            $d->id = $item->id;
            $d->name = $item->name;
            $d->unit_price = $item->unit_price.'₺';
            $d->description = $item->description;

            $array = array();
            foreach($item->actions as $action){
                array_push($array, $action->name);
            }
            $d->actions = $array;


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
        $actions = Action::all();
        if(count($actions) == 0)
            return redirect()->route('action.create');
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['name','description','unit_price', $actions],
            'fillables_titles' => ['İsim','Açıklama','Fiyat', 'Eyleyici'],
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
        $actuator = new Actuator;
        $actuator->name = $request->name;
        $actuator->description = $request->description;
        $actuator->unit_price = $request->unit_price;
        $actuator->save();
        $actuator->actions()->attach($request->actions);
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
    public function edit(Actuator $actuator)
    {
        $actions = Action::all();
        $insertedActionIds = array();
        foreach ($actuator->actions as $action) {
            array_push($insertedActionIds, $action->id);
        }
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['name','description','unit_price', [$actions, $insertedActionIds]],
            'fillables_titles' => ['İsim','Açıklama','Fiyat', 'Eyleyici'],
            'fillables_types' => $this->fillables_types,
            'data' => $actuator
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
    public function update(Request $request, Actuator $actuator)
    {
        $actuator->name = $request->name;
        $actuator->description = $request->description;
        $actuator->unit_price = $request->unit_price;
        $actuator->save();
        $actuator->actions()->sync($request->actions);

        return redirect()->route($this->route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actuator $actuator)
    {
        $actuator->actions()->detach();
        $actuator->delete();
        return redirect()->route($this->route.'.index')->with('success', $this->title.' silme işlemi başarılı bir şekilde gerçekleştirildi');;
    }
}
