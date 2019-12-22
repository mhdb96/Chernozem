<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyController extends Model
{
    protected $table = 'controllers';

    protected $fillable = ['name','description','unit_price'];

    public $timestamps = false;


    // public function inputs()
    // {
    //     return $this->belongsToMany('App\Models\Input');
    // }
    public function name()
    {
        return $this->name;
    }
}
