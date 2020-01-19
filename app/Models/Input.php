<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    protected $table = 'inputs';

    protected $fillable = ['name', 'firebase_code'];

    public $timestamps = false;

    // public function regions()
    // {
    //     return $this->belongsToMany('App\Models\Region');
    // }
    public function name()
    {
        return $this->name;
    }
}
