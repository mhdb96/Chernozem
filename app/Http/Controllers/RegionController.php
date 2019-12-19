<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Region;
use App\Models\Soil;
use App\Models\RegionSoil;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();

        return view('region.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $soils = Soil::all();

        return view('region.create', compact('soils'));
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
        $region->soils()->attach($soilIds);

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

        return view('region.edit', compact('region', 'soils', 'insertedSoilIds'));
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
    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('region.index');
    }
}
