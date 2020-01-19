<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = 'actions';

    protected $fillable = ['name', 'firebase_code'];

    public $timestamps = false;

    public function actuators()
    {
        return $this->belongsToMany('App\Models\Actuator');
    }
    public function name()
    {
        return $this->name;
    }
}
