<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Input;
use Illuminate\Support\Facades\DB;


class InputController extends Controller
{
    private $route = 'input';
    private $title = 'Giriş';
    private $fillables_types = ['text'];
    
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
            'fillables' => ['name'],
            'fillables_titles' => ['İsim'],
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
            'fillables' => ['name'],
            'fillables_titles' => ['İsim'],
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
        
        return view('input.chart', compact('input', 'mac_adress'));
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
            'fillables' => ['name'],
            'fillables_titles' => ['İsim'],
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
            $request->only(['name'])
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
