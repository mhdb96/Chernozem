<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionSoil extends Model
{
    protected $table = 'region_soil';

    protected $fillable = [];

    public $timestamps = false;
    
    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }
    
    public function soil()
    {
        return $this->belongsTo('App\Models\Soil');
    }

    public function name()
    {       
        return $this->region->name.'-'.$this->soil->name; 
    }
}

