<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Packet;
use App\Models\Soil;
use App\Models\Region;
use App\Models\Area;
use App\Models\Plant;
use App\Models\RegionSoil;
use App\Models\SoilPlant;
use App\Models\AreaCapacity;
use App\Models\Kit;

class PacketData{
    public $name;
    public $soil;
    public $plant;
    public $region;
    public $area;
    public $id;
}

class PacketController extends Controller
{
    private $route = 'packet';
    private $title = 'Paket';
    private $fillables = ['name','soil','plant','region','area'];
    private $fillables_titles = ['Isim','Toprak','Bitki','Iklim','Saha'];
    private $fillables_types = ['text','one','auto','auto','auto'];
    //['Isim','Iklimler','Topraklar','Bitkiler','Sahalar'
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packets = Packet::all();
        $data = array();
        foreach($packets as $packet){

            $soil = $packet->soilPlant->regionSoil->soil->name;
            $plant = $packet->soilPlant->plant->name;
            $region = $packet->soilPlant->regionSoil->region->name;
            $area = $packet->area->name;

            $name = $packet->name;
            $id= $packet->id;

            $d = new PacketData();
            $d->soil = $soil;
            $d->plant = $plant; 
            $d->region = $region; 
            $d->name = $name; 
            $d->area = $area; 

            $d->id = $id; 

            array_push($data,$d);

        } 
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'empty_space' => 400,
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

        $regions = Region::all();        
        if(count($regions) == 0)
            return redirect()->route('region.create');
        // $kits = Kit::all();        
        // if(count($kits) == 0)
        //     return redirect()->route('kit.create');
        $areas = collect();        
        $areas->add(new Area);

        $regionSoil = collect();        
        $regionSoil->add(new RegionSoil);

        $soilPlant = collect();        
        $soilPlant->add(new SoilPlant);        
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['name',$regions, $regionSoil, $soilPlant, $areas],
            'fillables_titles' => ['Isim','Iklim','Toprak','Bitki','Sahalar'],
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
        $packet = new Packet;
        $packet->name = $request->name;              
        $packet->area()->associate($request->areas); 
        $packet->soilPlant()->associate($request->soil_plant);                 
        $packet->save();   
        // $packet->kits()->attach($request->kits);                     
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
    public function edit(Packet $packet)
    {
        //TODO - Enable Validation!!!!!!!!!!!!!!!!!!!!!
        $data = DB::table('soil_plant')
            ->join('plants', 'plants.id', '=', 'soil_plant.plant_id')
            ->join('region_soil', 'region_soil.id', '=', 'soil_plant.region_soil_id')
            ->join('soils', 'soils.id', '=', 'region_soil.soil_id')
            ->join('regions', 'regions.id', '=', 'region_soil.region_id')
            ->join('packets', 'packets.soil_plant_id', '=', 'soil_plant.id')
            ->select('regions.id as region_id', 'soils.id as soil_id', 'plants.id as plant_id')
            ->where('packets.id',$packet->id)
            ->get()->first;        
        $regions = Region::all();
        $insertedRegionIds = array(); 
        array_push($insertedRegionIds, $data->plant_id->region_id);        
        $soils = collect();
        $soils->add(Soil::find($data->plant_id->soil_id));                    
        $insertedsoilIds = array();                            
        array_push($insertedsoilIds, $data->plant_id->soil_id);        
        $plants = collect();
        $plants->add(Plant::find($data->plant_id->plant_id)); 
        $insertedPlantIds = array();                            
        array_push($insertedPlantIds, $packet->soilPlant->id);
        $areas = collect();
        $getAreas = Area::where('area_capacity.plant_id', $data->plant_id->plant_id)
        ->join('area_capacity', 'area_capacity.area_id', '=', 'areas.id')->get();        
        if(count($getAreas) > 1)
        {
            $areas = $getAreas;
        }
        else {
            $areas->add($getAreas);
        }        
        $insertedAreaIds = array();                            
        array_push($insertedAreaIds, $packet->area->id);
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['name',[$regions, $insertedRegionIds], [$soils, $insertedsoilIds], [$plants, $insertedPlantIds],  [$areas, $insertedAreaIds]],
            'fillables_titles' => ['Isim','Iklimler','Topraklar','Bitkiler','Sahalar'],  
            'fillables_types' => $this->fillables_types,          
            'data' => $packet
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
    public function update(Request $request, Packet $packet)
    {        
        $packet->name = $request->name;              
        $packet->area()->associate($request->areas);
        $packet->soilPlant()->associate($request->plants);                 
        $packet->save();   
        // $packet->kits()->attach($request->kits);                     
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
        $isExist = DB::table('packet_kit')->where('packet_id', $id)->exists();
        if($isExist)
        {
            return redirect('/'.$this->route)
            ->with('warning', 'Bu '.$this->title.' türü diğer tablolarla ilişki olduğu için silemezsiniz.');
        }       

            Packet::find($id)->delete();
            return redirect('/'.$this->route)
                ->with('success', $this->title.' silme işlemi başarılı bir şekilde gerçekleştirildi');

        /*
        $packet->delete();
        return redirect()->route($this->route.'.index');*/
    }
}
