<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    protected $table = 'packets';

    protected $fillable = ['name'];

    public $timestamps = false;


    // public function sensors()
    // {
    //     return $this->belongsToMany('App\Models\Sensor', 'kit_sensor');
    // }
    // public function actuators()
    // {
    //     return $this->belongsToMany('App\Models\Actuator', 'kit_actuator');
    // }
    public function soilPlant()
    {
        return $this->belongsTo('App\Models\SoilPlant');
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }

    public function kits()
    {
        return $this->belongsToMany('App\Models\Kit','packet_kit')->withPivot('count');
    }

    public function name()
    {
        return $this->name;
    }
}