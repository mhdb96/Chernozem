<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{    
    protected $table = 'customers';
    
    protected $fillable = [
        'first_name', 'last_name','user_id'
    ];

    public $timestamps = false;

    public function name()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }
     
}