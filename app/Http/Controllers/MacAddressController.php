<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use DB;

class Data{
    public $name;
    public $projects = array();
    public $kits=array();
    public $id;

    /*
    public $soil;
    public $plant;
    public $region;
    public $area;*/
}


class MacAddressController extends Controller
{
    private $route = 'mac-address';
    private $title = 'Mac';
    private $fillables = ['name','projects','kits'];
    private $fillables_titles = ['Isim','Proje Adı','Kit Adı'];
    private $fillables_types = ['one'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        //dd($customers);
        
        $data = array();

        foreach($customers as $customer){
/*
            $soil = $customer->soilPlant->regionSoil->soil->name;
            $plant = $customer->soilPlant->plant->name;
            $region = $packet->soilPlant->regionSoil->region->name;
            $area = $packet->area->name;
*/          
            $name = $customer->first_name.' '.$customer->last_name;
            $id= $customer->id;
            
            $projects = DB::table('projects')
            ->select('projects.name','projects.id')
            ->join('customers', 'customers.id', '=', 'projects.customer_id')
            ->where('customers.id', $customer->id)
            ->get();

            $project_array = array();
            $kit_array = array();

            foreach($projects as $project){

                $kits = DB::table('projects')
                ->select('project_area_kit.name')
                ->join('project_area', 'projects.id', '=', 'project_area.project_id')
                ->join('project_area_kit', 'project_area_kit.project_area_id', '=', 'project_area.id')
                ->where('projects.id', $project->id)
                ->get();

                foreach($kits as $kit){
                    array_push($kit_array, $kit->name);
                }

                array_push($project_array, $project->name);
                
            }
            
            $d = new Data();/*
            $d->soil = $soil;
            $d->plant = $plant; 
            $d->region = $region;
            $d->area = $area; 
 */
            
            $d->name = $name; 
            $d->projects = $project_array;
            $d->kits = $kit_array;
            $d->id = $id; 

            array_push($data,$d);

        } 
        //dd($data);
        
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'empty_space' => 400,
            'data' => $data
        );

        return view($this->route.'.index')->with($my_data);
/*

        $packets = Packet::all();
        $data = array();
        foreach($packets as $packet){

            $soil = $packet->soilPlant->regionSoil->soil->name;
            $plant = $packet->soilPlant->plant->name;
            $region = $packet->soilPlant->regionSoil->region->name;
            $area = $packet->area->name;

            $name = $packet->name;
            $id= $packet->id;

            $d = new Data();
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
        //

        //return view('mac-address.index');
*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data = Customer::find($id);
        
        //
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'fillables_types' => $this->fillables_types,          
            'data' => $data
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
