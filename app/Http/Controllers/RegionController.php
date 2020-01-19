<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\Region;
use App\Models\Soil;
use App\Models\RegionSoil;

class RegionData{
    public $id;
    public $name;
    public $soils = array();
}

class RegionController extends Controller
{
    private $route = 'region';
    private $title = 'İklim';
    private $fillables_types = ['text','many'];
    private $fillables = ['name','soils'];
    private $fillables_titles = ['İsim','Topraklar'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $regions = Region::all();

        $data = array();
        foreach($regions as $item){
            $d = new RegionData();
            $d->id = $item->id;
            $d->name = $item->name;
            $array = array();
            foreach($item->soils as $soil){
                array_push($array, $soil->name);
            }
            //array_push($d->soil,$array);
            $d->soils = $array;
            array_push($data,$d);
        }

        $my_data = array(
            'title' => 'İklim',
            'route' => 'region',
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'empty_space' => 1000,
            'data' => $data
        );
        return view('region.index')->with($my_data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $soils = Soil::all();
        //dd($soils);
        if(count($soils) == 0)
            return redirect()->route('soil.create');
        $my_data = array(
            'title' => 'Iklim',
            'route' => 'region',
            'fillables' => ['name', $soils],
            'fillables_titles' => ['name','Topraklar'],
            'fillables_types' => $this->fillables_types,
            'is_multiple' => false
        );
        return view('region.create')->with($my_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Created new record in regions table

        $region = new Region;

        $region->name = $request->name;
        $region->save();



        // Created new record or records in region_soil table (pivot table)
        $region->soils()->attach($request->soils);

        return redirect()->route('region.index');
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
    public function edit(Region $region)
    {
        $soils = Soil::all();

        // Inserted soil ids collected in an array
        $insertedSoilIds = array();
        foreach ($region->soils as $soil) {
            array_push($insertedSoilIds, $soil->id);
        }
        $my_data = array(
            'title' => 'Iklim',
            'route' => 'region',
            'fillables' => ['name',[$soils , $insertedSoilIds]],
            'fillables_titles' => ['İsim', 'Topraklar'],
            'fillables_types' => $this->fillables_types,
            'data' => $region
        );
        return view('region.edit')->with($my_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        // Updated the exist region
        $region->name = $request->name;
        $region->save();

        // Updated the exist record or records in region_soil table (pivot table)
        $region->soils()->sync($request->soils);

        return redirect()->route('region.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $items=RegionSoil::select('id')->where('region_id',$id)->get();
        foreach($items as $item){
            $isExist = DB::table('soil_plant')->where('region_soil_id', $item->id)->exists();

            if($isExist)
            {
            return redirect('/'.$this->route)
            ->with('warning', 'Bu '.$this->title.' türü diğer tablolarla ilişki olduğu için silemezsiniz.');
            } 
        }
            Region::find($id)->soils()->detach();
            Region::find($id)->delete();
            return redirect('/'.$this->route)
                ->with('success', $this->title.' silme işlemi başarılı bir şekilde gerçekleştirildi');
        /*
        
        $region->soils()->detach();
        $region->delete();

        return redirect()->route('region.index');*/
    }
}
