<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plant;
use App\Models\Unit;
use App\Models\Type;


class PlantController extends Controller
{
    private $route = 'plant';
    private $title = 'Bitki';
    private $fillables = ['name','unit_price'];
    private $fillables_titles = ['Isim','Fiyat'];
    private $fillables_types = ['text','text','one','one'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plants = Plant::all();
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'empty_space' => 700,
            'data' => $plants
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
        $types = Type::all();        
        $units = Unit::all();        
        if(count($types) == 0)
            return redirect()->route('type.create');
        if(count($units) == 0)
            return redirect()->route('unit.create');
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['name','unit_price' ,$types, $units],
            'fillables_titles' => ['Isim','Fiyat','Tipler','Unite'],
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
        $plant = new Plant;
        $plant->name = $request->name;        
        $plant->unit_price = $request->unit_price;        
        $plant->type()->associate($request->types); 
        $plant->unit()->associate($request->units);         
        $plant->save();                         
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
    public function edit(Plant $plant)
    {
        $types = Type::all();
        $insertedTypesIds = array();                            
        array_push($insertedTypesIds, $plant->type->id);

        $units = Unit::all();
        $insertedUnitIds = array();                            
        array_push($insertedUnitIds, $plant->unit->id);


        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['name','unit_price',[$types, $insertedTypesIds], [$units, $insertedUnitIds] ],
            'fillables_titles' => ['Isim','Fiyat','Tipler','Uniteler'],  
            'fillables_types' => $this->fillables_types,          
            'data' => $plant
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
    public function update(Request $request, Plant $plant)
    {
        $plant->name = $request->name;
        $plant->unit_price = $request->unit_price;
        $plant->type()->associate($request->types);          
        $plant->unit()->associate($request->units);
        $plant->save();        
        return redirect()->route($this->route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plant $plant)
    {
        $plant->delete();
        return redirect()->route($this->route.'.index');
    }
}
