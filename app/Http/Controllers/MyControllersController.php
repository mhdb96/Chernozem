<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyController;
use Illuminate\Support\Facades\DB;

class MyControllerData{
    public $id;
    public $name;
    public $unit_price;
    public $description;
}


class MyControllersController extends Controller
{
    private $route = 'controller';
    private $title = 'Kontrolor';
    private $fillables = ['name','description','unit_price'];
    private $fillables_titles = ['Isim','Aciklama','Fiyat'];
    private $fillables_types = ['text','text','number'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $controllers = MyController::all();

        $data = array();
        foreach($controllers as $item){
            $d = new MyControllerData();
            $d->id = $item->id;
            $d->name = $item->name;
            $d->unit_price = $item->unit_price.'₺';
            $d->description = $item->description;
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

        if(count($request->name) == count($request->description)  && count($request->name) == count($request->unit_price)) {
            for ($i=0; $i < count($request->name); $i++) {
                MyController::create([
                    'name'      => $request->name[$i],
                    'description' => $request->description[$i],
                    'unit_price' => $request->unit_price[$i],
                ]);
            }
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
    public function edit(MyController $controller)
    {
        $my_data = array(
            'title' => $this->title,
            'route' => $this->route,
            'fillables' => $this->fillables,
            'fillables_titles' => $this->fillables_titles,
            'fillables_types' => $this->fillables_types,
            'data' => $controller
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
    public function update(Request $request, MyController $controller)
    {
        $controller ->update(
            $request->only($this->fillables)
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

        $isExist = DB::table('kits')->where('controller_id', $id)->exists();
        if($isExist)
        {
            return redirect('/'.$this->route)
            ->with('warning', 'Bu '.$this->title.' türü diğer tablolarla ilişki olduğu için silemezsiniz.');
        }       


            MyController::find($id)->delete();
            return redirect('/'.$this->route)
                ->with('success', $this->title.' silme işlemi başarılı bir şekilde gerçekleştirildi');

                /*
        try {
            $controller->delete();
        } catch (\Throwable $th) {
            // TODO - mesaj gönderilecek.
            // mesaj gönderilecek.
            return redirect()->route($this->route.'.index');
        }
        return redirect()->route($this->route.'.index');*/
    }
}
