<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\RegionSoil;
use App\Models\SoilPlant;
use App\Models\Kit;
use App\Models\ProjectAreaKit;

class AjaxController extends Controller
{
    public function formatData($data) 
    {
        $formattedData = [];
        foreach ($data as $item) {
            $formattedData[] = [
                'id'   => $item->id, 
                'text' => $item->name
            ];
        }
        return \Response::json($formattedData);
    }

    public function getRegionSoils(Request $request)
    {        
        $regionSoils = DB::table('region_soil')
            ->select('region_soil.id', 'soils.name')
            ->join('soils', 'soils.id', '=', 'region_soil.soil_id')
            ->where('region_soil.region_id', $request->id)
            ->get();

        return $this->formatData($regionSoils);
    }

    public function getSoilPlants(Request $request)
    {         
        $soilPlants = DB::table('soil_plant')
            ->select('soil_plant.id', 'plants.name')
            ->join('plants', 'plants.id', '=', 'soil_plant.plant_id')
            ->where('soil_plant.region_soil_id', $request->id)
            ->get();

        return $this->formatData($soilPlants);
    }

    public function getAreas(Request $request)
    {   
        $soildPlant = DB::table('soil_plant')->where('id', $request->id )->select('plant_id')->get()->first();
        $areas = DB::table('area_capacity')
            ->select('areas.id', 'areas.name')
            ->join('areas', 'areas.id', '=', 'area_capacity.area_id')
            ->where([
                ['area_capacity.plant_id', '=', $soildPlant->plant_id],
                ['area_capacity.capacity', '<>', ''],
            ])
            ->get();

        return $this->formatData($areas);        
    }

    public function controlData(Request $request)
    {   
        $controlData = [];
        if(!empty($request->region_id) && !empty($request->soilIds)) {

            foreach ($request->soilIds as $soil_id) {
                $regionSoil = RegionSoil::where([
                    ['region_id', $request->region_id],
                    ['soil_id', $soil_id],
                ])->get()->first();
                
                $soilPlants = SoilPlant::where('region_soil_id', $regionSoil->id)->get();

                if(count($soilPlants) > 0) 
                    $controlData[] = ['isOpen' => true, 'soil_id' => $soil_id];
                else 
                    $controlData[] = ['isOpen' => false, 'soil_id' => $soil_id];
            }
        }
        return \Response::json($controlData);
    }

    public function getPacketKitCount(Request $request)
    {   
        $selectedKitCount = DB::table('packet_kit')->where([
            ['packet_id', '=', $request->packet_id],
            ['kit_id', '=', $request->kit_id]
        ])->select('count')->first();

        return \Response::json($selectedKitCount);
    }
    
    public function getPacketKitInputs(Request $request)
    {   
        $kit = Kit::find($request->kit_id);
        $inputs = array();
        foreach ($kit->sensors as $sensor) {
          foreach($sensor->inputs as $input){
            $i = array(
                'id' => $input->id,
                'name' => $input->name
            );
            array_push($inputs, $i);            
          }
        } 
        return \Response::json($inputs);
    }
    public function GetMacCount(Request $request)
    {   
        $pak = ProjectAreaKit::where('mac_adress',null)->get();
        //dd($pak); 
        return \Response::json(count($pak));
    }
}
