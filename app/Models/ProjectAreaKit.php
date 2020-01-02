<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAreaKit extends Model
{
    protected $table = 'project_area_kit';

    protected $fillable = [
        'name', 'is_online', 'mac_adress'
    ];

    public $timestamps = false;

    public function projectArea()
    {
        return $this->belongsTo('App\Models\ProjectArea');
    }
    public function kit()
    {
        return $this->belongsTo('App\Models\Kit');
    }
}