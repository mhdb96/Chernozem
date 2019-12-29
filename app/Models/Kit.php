<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    protected $table = 'kits';

    protected $fillable = ['name','description'];

    public $timestamps = false;


    public function sensors()
    {
        return $this->belongsToMany('App\Models\Sensor', 'kit_sensor');
    }
    public function actuators()
    {
        return $this->belongsToMany('App\Models\Actuator', 'kit_actuator');
    }
    public function myController()
    {
        return $this->belongsTo('App\Models\MyController', 'controller_id');
    }

    public function packets()
    {
        return $this->belongsToMany('App\Models\Packet','packet_kit')->withPivot('count');
    }

    public function projectArea()
    {
        return $this->belongsToMany('App\Models\ProjectArea', 'project_area_kit')->withPivot('name');
    }

    public function name()
    {
        return $this->name;
    }
}