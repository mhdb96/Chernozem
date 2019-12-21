<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $table = 'sensors';

    protected $fillable = ['name','description','unit_price'];

    public $timestamps = false;


    public function inputs()
    {
        return $this->belongsToMany('App\Models\Input');
    }
}
