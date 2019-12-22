<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Packet;
use App\Models\Soil;
use App\Models\Region;
use App\Models\Area;
use App\Models\Plant;
use App\Models\RegionSoil;
use App\Models\SoilPlant;
use App\Models\AreaCapacity;

class PacketController extends Controller
{
    private $route = 'packet';
    private $title = 'Paket';
    private $fillables = ['name'];
    private $fillables_titles = ['Isim'];
    private $fillables_types = ['text','one','auto','auto','one'];
    //['Isim','Iklimler','Topraklar','Bitkiler','Sahalar'
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packets = Packet::all();
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'empty_space' => 1000,
            'data' => $packets
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
        $areas = Area::all();
        if(count($areas) == 0)
            return redirect()->route('area.create');

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
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
