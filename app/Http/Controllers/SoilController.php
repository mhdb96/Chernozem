<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Soil;

class SoilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soils = Soil::all();

        return view('soil.index', compact('soils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('soil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(count($request->name) == count($request->fertility)) {
            for ($i=0; $i < count($request->name); $i++) { 
                Soil::create([
                    'name'      => $request->name[$i],
                    'fertility' => $request->fertility[$i],
                ]);
            }
        }
        
        return redirect()->route('soil.index');
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
    public function edit(Soil $soil)
    {
        return view('soil.edit', compact('soil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soil $soil)
    {
        $soil->update(
            $request->only(['name', 'fertility'])
        );

        return redirect()->route('soil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soil $soil)
    {
        $soil->delete();

        return redirect()->route('soil.index');
    }
}
