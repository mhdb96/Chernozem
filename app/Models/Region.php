<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function soils()
    {
        return $this->belongsToMany('App\Models\Soil');
    }
}
