<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionSoil extends Model
{
    protected $table = 'region_soil';

    protected $fillable = ['region_id', 'soil_id'];

    public $timestamps = false;
}
