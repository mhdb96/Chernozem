<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PacketKit extends Model
{
    protected $table = 'packet_kit';

    protected $fillable = [
        'count', //'kit_id', 'packet_id'
    ];

    public $timestamps = false;

    public function input_limits()
    {
        return $this->belongsToMany('App\Models\Input', 'packet_kit_input_limits')->withPivot('value');
    }
    public function packet()
    {
        return $this->belongsTo('App\Models\Packet');
    }
    public function kit()
    {
        return $this->belongsTo('App\Models\Kit');
    }

}
