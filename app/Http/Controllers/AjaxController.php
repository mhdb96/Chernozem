<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Region;
use App\Models\Soil;

class AjaxController extends Controller
{
    public static function formatData($data) 
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
            ->where('region_soil.region_id', $request->regionId)
            ->get();

        return self::formatData($regionSoils);
    }

    public function getSoilPlants(Request $request)
    {        
        $soilPlants = DB::table('soil_plant')
            ->select('plants.id', 'plants.name')
            ->join('plants', 'plants.id', '=', 'soil_plant.plant_id')
            ->where('soil_plant.region_soil_id', $request->regionSoilId)
            ->get();

        return self::formatData($soilPlants);
    }

    public function getAreas(Request $request)
    {        
        $areas = DB::table('area_capacity')
            ->select('areas.id', 'areas.name')
            ->join('areas', 'areas.id', '=', 'area_capacity.area_id')
            ->where([
                ['area_capacity.plant_id', '=', $request->plantId],
                ['area_capacity.capacity', '<>', ''],
            ])
            ->get();

        return self::formatData($areas);
    }
}
