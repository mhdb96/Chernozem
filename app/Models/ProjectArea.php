<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectArea extends Model
{
    protected $table = 'project_area';

    protected $fillable = [
        'name', 'area_id', 'project_id'
    ];

    public $timestamps = false;

    public function kits()
    {
        return $this->belongsToMany('App\Models\Kit', 'project_area_kit')->withPivot('name');
    }
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }

}
