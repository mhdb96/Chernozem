<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActuatorActionData extends Model
{    
    protected $table = 'actuator_action_data';
    
    protected $fillable = [
        'value'
    ];

    public $timestamps = false;     
}