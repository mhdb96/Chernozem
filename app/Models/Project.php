<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name', 'start_date', 'end_date', 'budget', 'packet_id', 'customer_id', 'owns_area', 'area_count'
    ];

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function packet()
    {
        return $this->belongsTo('App\Models\Packet');
    }

    public function areas()
    {
        return $this->belongsToMany('App\Models\Area', 'project_area')->withPivot('name');
    }

    public function projectArea()
    {
        return $this->hasMany('App\Models\ProjectArea');
    }
}
