<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;
use Illuminate\Support\Facades\DB;


class ActionController extends Controller
{
    private $route = 'action';
    private $title = 'Eylem';
    private $fillables = ['name', 'firebase_code'];
    private $fillables_titles = ['Isim','Firebase Kodu'];
    private $fillables_types = ['text','text'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actions = Action::all();
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'empty_space' => 1000,
            'data' => $actions
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
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'fillables_types' => $this->fillables_types,
            'is_multiple' => true
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
        for ($i=0; $i < count($request->name); $i++) {
            Action::create([
                'name'      => $request->name[$i],
                'firebase_code'      => $request->firebase_code[$i],
            ]);
        }
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
    public function edit(Action $action)
    {
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'fillables_types' => $this->fillables_types,
            'data' => $action
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
    public function update(Request $request, Action $action)
    {
        $action->update(
            $request->only(['name', 'firebase_code'])
        );

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
        $isExist = DB::table('action_actuator')->where('action_id', $id)->exists();

        if($isExist)
        {
            return redirect('/'.$this->route)
            ->with('warning', 'Bu '.$this->title.' türü diğer tablolarla ilişki olduğu için silemezsiniz.');
        }       


            Action::find($id)->delete();
            return redirect('/'.$this->route)
                ->with('success', $this->title.' silme işlemi başarılı bir şekilde gerçekleştirildi');
        /*
        try {
            $action->delete();
        } catch (\Throwable $th) {
            // TODO - mesaj gönderilecek.
            // mesaj gönderilecek.
            return redirect()->route($this->route.'.index');
        }
        return redirect()->route($this->route.'.index');*/
    }
}
