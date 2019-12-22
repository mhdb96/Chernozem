<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaCapacity extends Model
{
    protected $table = 'area_capacity';

    protected $fillable = ['capacity'];

    public $timestamps = false;


    // public function sensors()
    // {
    //     return $this->belongsToMany('App\Models\Sensor', 'kit_sensor');
    // }
    // public function actuators()
    // {
    //     return $this->belongsToMany('App\Models\Actuator', 'kit_actuator');
    // }
    public function plant()
    {
        return $this->belongsTo('App\Models\Plant');
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }    
}