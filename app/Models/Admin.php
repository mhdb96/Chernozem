<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    
    protected $fillable = [
        'first_name', 'last_name','user_id'
    ];

    public $timestamps = false; 
}
