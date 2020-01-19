<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Input;
use App\Models\ProjectAreaKit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class InputController extends Controller
{
    private $route = 'input';
    private $title = 'Giriş';
    private $fillables_types = ['text','text'];
    
    public function __construct()
    {
        $this->middleware('admin')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inputs = Input::all();

        $my_data = array(
            'title' => 'Giriş',
            'route' => 'input',
            'fillables' => ['name','firebase_code'],
            'fillables_titles' => ['İsim','Firebase Kodu'],
            'empty_space' => 1000,
            'data' => $inputs


        );
        return view('input.index')->with($my_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $my_data = array(
            'title' => 'Giriş',
            'route' => 'input',
            'fillables' => ['name','firebase_code'],
            'fillables_titles' => ['İsim','Firebase Kodu'],
            'fillables_types' => $this->fillables_types,
            'is_multiple' => true
        );
        return view('input.create')->with($my_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            for ($i=0; $i < count($request->name); $i++) {
                Input::create([
                    'name'      => $request->name[$i],
                    'firebase_code' => $request->firebase_code[$i],
                ]);
            }
        return redirect()->route('input.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Input $input, Request $request)
    {
        $mac_adress = $request->session()->get('mac_adress');
        $pak = ProjectAreaKit::where('mac_adress',$mac_adress)->get()->first();
        //dd($mac_adress);
        $data;
        $s = $pak->kit->sensors;
        $sensorInputId = -1;
        foreach ($s as $se) {            
            foreach ($se->inputs as $i) {
                if($i->id == $input->id) {
                    $sensorInputId = DB::table('input_sensor')->select('id')->where([['sensor_id',$se->id],['input_id',$i->id]])->get()->first()->id;
                    //dd($sensorInputId);
                }
            }
        }
        if($sensorInputId != -1) {
            //dd($pak->id);
            $data = DB::table('sensor_input_data')->select('value','created_at')->where([['project_area_kit_id',$pak->id],['sensor_input_id',$sensorInputId]])->get();
        }
        $time = array();
        $values = array();
        foreach ($data as $d) {
            $t = Str::before($d->created_at, ' ');
           
            array_push($time, $t);
            array_push($values, $d->value);
        }
        //dd($time);
        return view('input.chart', compact('input', 'mac_adress','time','values'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Input $input)
    {
        $my_data = array(
            'title' => 'Giriş',
            'route' => 'input',
            'fillables' => ['name','firebase_code'],
            'fillables_titles' => ['İsim', 'Firebase Kodu'],
            'fillables_types' => $this->fillables_types,
            'data' => $input
        );
        return view('input.edit')->with($my_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Input $input)
    {
        $input->update(
            $request->only(['name', 'firebase_code'])
        );

        return redirect()->route('input.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isExist = DB::table('input_sensor')->where('input_id', $id)->exists();

        if($isExist)
        {
            return redirect('/'.$this->route)
            ->with('warning', 'Bu '.$this->title.' türü diğer tablolarla ilişki olduğu için silemezsiniz.');
        }       
            Input::find($id)->delete();
            return redirect('/'.$this->route)
                ->with('success', $this->title.' silme işlemi başarılı bir şekilde gerçekleştirildi');

        /*
        try {
            $input->delete();
        } catch (\Throwable $th) {
            // TODO - mesaj gönderilecek.
            // mesaj gönderilecek.
            return redirect()->route('input.index');
        }
        return redirect()->route('input.index');*/
    }
}
