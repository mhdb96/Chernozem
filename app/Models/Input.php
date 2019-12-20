<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    protected $table = 'inputs';

    protected $fillable = ['name'];

    public $timestamps = false;

    // public function regions()
    // {
    //     return $this->belongsToMany('App\Models\Region');
    // }
}
