<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';

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
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function name()
    {
        return $this->name;
    }
}