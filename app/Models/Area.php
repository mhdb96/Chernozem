<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = ['name', 'unit_price'];
    
    public $timestamps = false;


    // public function sensors()
    // {
    //     return $this->belongsToMany('App\Models\Sensor', 'kit_sensor');
    // }
    // public function actuators()
    // {
    //     return $this->belongsToMany('App\Models\Actuator', 'kit_actuator');
    // }
    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project', 'project_area')->withPivot('name');
    }

    public function areaCapacity()
    {
        return $this->hasOne('App\Models\AreaCapacity');
    }

    public function name()
    {
        return $this->name;
    }
}