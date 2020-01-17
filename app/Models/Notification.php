<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{    
    protected $table = 'notifications';
    
    protected $fillable = [
        'customer_id', 'input_id', 'notification'
    ];

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
     
}