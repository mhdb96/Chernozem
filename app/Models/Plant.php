<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $table = 'plants';

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
}