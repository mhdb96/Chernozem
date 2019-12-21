<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Soil;

class SoilController extends Controller
{
    private $fillables_types = ['text','text'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soils = Soil::all();
        $my_data = array(
            'title' => 'Toprak',
            'route' => 'soil',
            'fillables' => ['name', 'fertility'],
            'fillables_titles' => ['İsim', 'Verimlilik'],
            'empty_space' => 500,
            'data' => $soils


        );
        return view('soil.index')->with($my_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $my_data = array(
            'title' => 'Toprak',
            'route' => 'soil',
            'fillables' => ['name','fertility'],
            'fillables_titles' => ['İsim','Verimlilik'],
            'fillables_types' => $this->fillables_types,
            'is_multiple' => true
        );
        return view('soil.create')->with($my_data);
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
        $my_data = array(
            'title' => 'Toprak',
            'route' => 'soil',
            'fillables' => ['name','fertility'],
            'fillables_titles' => ['İsim', 'Verimlilik'],
            'fillables_types' => $this->fillables_types,
            'data' => $soil
        );
        return view('soil.edit')->with($my_data);
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
        try {
            $soil->delete();
        } catch (\Throwable $th) {
            // TODO - mesaj gönderilecek.
            // mesaj gönderilecek.
            return redirect()->route('soil.index');
        }


        return redirect()->route('soil.index');
    }
}
