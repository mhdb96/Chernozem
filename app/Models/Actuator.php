<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actuator extends Model
{
    protected $table = 'actuators';

    protected $fillable = ['name','description','unit_price'];

    public $timestamps = false;


    public function actions()
    {
        return $this->belongsToMany('App\Models\Action');
    }
    public function name()
    {
        return $this->name;
    }
}
