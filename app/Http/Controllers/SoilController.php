<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Soil;
use App\Models\RegionSoil;

class SoilData{
    public $id;
    public $name;
    public $fertility;
}

class SoilController extends Controller
{
    private $route = 'soil';
    private $title = 'Toprak';
    private $fillables_types = ['text','number'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soils = Soil::all();
        $data=array();

        foreach($soils as $soil){
            $d = new SoilData();
            $d->id = $soil->id;
            $d->name = $soil->name; 
            $d->fertility = $soil->fertility.'%';
            array_push($data,$d);
        }
        $my_data = array(
            'title' => 'Toprak',
            'route' => 'soil',
            'fillables' => ['name', 'fertility'],
            'fillables_titles' => ['İsim', 'Verimlilik'],
            'empty_space' => 500,
            'data' => $data
            


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
    public function destroy($id)
    {

        $isExist = RegionSoil::where('soil_id', $id)->exists();
        
        if($isExist)
        {
            return redirect('/'.$this->route)
            ->with('warning', 'Bu '.$this->title.' türü diğer tablolarla ilişki olduğu için silemezsiniz.');
        }       

            Soil::find($id)->delete();
            return redirect('/'.$this->route)
                ->with('success',  $this->title.' silme işlemi başarılı bir şekilde gerçekleştirildi');

        /*
        try {
            $soil->delete();
        } catch (\Throwable $th) {
            // TODO - mesaj gönderilecek.
            // mesaj gönderilecek.
            return redirect()->route('soil.index');
        }*/

        Soil::find($id)->delete();

    }
}
