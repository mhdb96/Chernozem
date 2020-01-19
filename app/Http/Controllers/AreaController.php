<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Area;
use App\Models\Unit;
use App\Models\Type;


class AreaData{
    public $id;
    public $name;
    public $unit_price;
    public $type;
    public $unit;
}

class AreaController extends Controller
{
    private $route = 'area';
    private $title = 'Saha';
    private $fillables = ['name','unit_price','type','unit'];
    private $fillables_titles = ['Isim','Fiyat','Tip','Birim'];
    private $fillables_types = ['text','number','one','one'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();

        $data = array();
        foreach($areas as $item){
            $d = new AreaData();
            $d->id = $item->id;
            $d->name = $item->name;
            $d->unit_price = $item->unit_price.'₺';
            $d->type = $item->type->name;
            $d->unit = $item->unit->name;
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
        $types = Type::where('category_id','=','9')->get();        
        $units = Unit::where('type_id','=','13')->get();        
        if(count($types) == 0)
            return redirect()->route('type.create');
        if(count($units) == 0)
            return redirect()->route('unit.create');
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['name','unit_price' ,$types, $units],
            'fillables_titles' => ['Isim','Fiyat','Tipler','Birim'],
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
        $area = new Area;
        $area->name = $request->name;        
        $area->unit_price = $request->unit_price;        
        $area->type()->associate($request->types); 
        $area->unit()->associate($request->units);         
        $area->save();                         
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
    public function edit(Area $area)
    {
        //$types = Type::all();
        $types = Type::where('category_id','=','9')->get();        
        $units = Unit::where('type_id','=','13')->get();        
        $insertedTypesIds = array();                            
        array_push($insertedTypesIds, $area->type->id);

        //$units = Unit::all();
        $units = Unit::where('type_id','=','13')->get();        

        $insertedUnitIds = array();                            
        array_push($insertedUnitIds, $area->unit->id);


        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['name','unit_price',[$types, $insertedTypesIds], [$units, $insertedUnitIds] ],
            'fillables_titles' => ['Isim','Fiyat','Tipler','Uniteler'],  
            'fillables_types' => $this->fillables_types,          
            'data' => $area
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
    public function update(Request $request, Area $area)
    {
        $area->name = $request->name;
        $area->unit_price = $request->unit_price;
        $area->type()->associate($request->types);          
        $area->unit()->associate($request->units);
        $area->save();        
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
        $isExistCapacity = DB::table('area_capacity')->where('area_id', $id)->exists();
        $isExistPackets = DB::table('packets')->where('area_id', $id)->exists();
        $isExistProject = DB::table('project_area')->where('area_id', $id)->exists();

        if($isExistCapacity | $isExistPackets | $isExistProject)
        {
            return redirect('/'.$this->route)
            ->with('warning', 'Bu '.$this->title.' türü diğer tablolarla ilişki olduğu için silemezsiniz.');
        }       

            Area::find($id)->delete();
            return redirect('/'.$this->route)
                ->with('success', $this->title.' silme işlemi başarılı bir şekilde gerçekleştirildi');

        /*
        $area->delete();
        return redirect()->route($this->route.'.index');*/
    }
}
