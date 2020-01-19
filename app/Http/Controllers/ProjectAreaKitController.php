<?php

namespace App\Http\Controllers;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\ProjectAreaKit;
use App\Models\Kit;
use DB;

class ProjectAreaKitData{
    public $name;
    public $project;
    public $kit;
    public $customer;
    public $id;
}


class ProjectAreaKitController extends Controller
{
    private $route = 'project-area-kit';
    private $title = 'Mac';
    private $fillables = ['name','project','customer','kit'];
    private $fillables_titles = ['Isim','Proje Adı','Musteri','Kit Adı'];
    private $fillables_types = ['text'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectAreaKits = ProjectAreaKit::Where('mac_adress','=',null)->get();
        $data = array();
        foreach($projectAreaKits as $item){
            $d = new ProjectAreaKitData();
            $d->id = $item->id;
            $d->name = $item->name;
            $d->project = $item->projectArea->project->name;
            $d->customer = $item->projectArea->project->customer->name();
            $d->kit = $item->kit->name;
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

        return view($this->route.'.index')->with($my_data);
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
        $pik = ProjectAreaKit::find($id);
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => ['mac_adress'],
            'fillables_titles' => ['Mac Adresi'],
            'fillables_types' => $this->fillables_types,
            'data' => $pik
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
    public function update(Request $request, $id)
    {
        $pak = ProjectAreaKit::find($id);        
        $pak->mac_adress = $request->mac_adress; 
        $pak->is_online = 1;        
        $pak->save();

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
        //
    }
}
