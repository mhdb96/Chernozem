<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoilPlant extends Model
{
    protected $table = 'soil_plant';

    protected $fillable = [];

    public $timestamps = false;
    
    public function plant()
    {
        return $this->belongsTo('App\Models\Plant');
    }
    
    public function regionSoil()
    {
        return $this->belongsTo('App\Models\RegionSoil');
    }

    public function name()
    {       
        return $this->regionSoil->name().'-'.$this->plant->name; 
    }
}

