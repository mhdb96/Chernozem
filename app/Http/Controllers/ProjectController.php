<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Packet;
use App\Models\Area;
use App\Models\Project;
use App\Models\Region;

use Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $areas = Area::all();

        $packet_id = $request->packet_id;
        $packet = Packet::find($packet_id);
        $kits = $packet->kits;
        
        $controllerPrice = 0;
        $actuatorPrice = 0;
        $sensorPrice = 0;
        
        foreach ($kits as $key => $kit) {
            $actuatorPrice += $kit->myController->unit_price; // get and add controller price

            foreach ($kit->actuators as $actuator) 
                $actuatorPrice += $actuator->unit_price; // get and add actuator price

            foreach ($kit->sensors as $sensor) 
                $sensorPrice += $sensor->unit_price; // get and add sensor price
        }
        
        $packetArea = $packet->area; // areas table
        $areaPrice = $packetArea->unit_price; // area price
        
        $areaCapacity = $packetArea->areaCapacity; // area_capacity table
        $capacity = $areaCapacity->capacity;
        $plantUnitPrice = $areaCapacity->plant->unit_price;
        $plantPrice = $capacity * $plantUnitPrice; // area_capacity * plant price 

        $budget = $controllerPrice + $actuatorPrice + $sensorPrice + $areaPrice + $plantPrice;

        return view('project.create', compact('packet', 'areas', 'budget', 'packet_id'));
    }

    /**
     * Show the form for finding project.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeCreate()
    {
        $regions = Region::all(); 

        return view('project.before-create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $packet = Packet::find($request->packet_id);
        $kits = $packet->kits;

        // project store
        $project = new Project;
        $project->name = $request->name;
        $project->start_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $request->start_date)));
        $project->end_date = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $request->end_date)));
        $project->budget = $request->budget;
        $project->packet_id = $request->packet_id;  
        $project->customer_id = Auth::user()->customer->id;  
        $project->owns_area = $request->owns_area;
        $project->area_count = $request->area_count; 
        $project->save();
        
        // project_area store
        foreach ($request->area_names as $name) {
            $project->areas()->attach($packet->area->id, ['name' => $name]);
        }

        // project_area_kit store
        foreach ($project->projectArea as $projectArea) {
            foreach ($kits as $kit) {
                $projectAreaKitName = $projectArea->name.'_'.$kit->name;
                $projectArea->kits()->attach($kit->id, ['name' => $projectAreaKitName]);
            }
        }
        
        return redirect()->route('project.show', $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $projectAreas = $project->projectArea;

        return view('project.index', compact('projectAreas', 'project'));
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
