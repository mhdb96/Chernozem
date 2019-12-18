<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soil extends Model
{
    protected $table = 'soils';

    protected $fillable = ['name', 'fertility'];

    public $timestamps = false;
}
