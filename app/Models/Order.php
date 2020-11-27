<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class Order extends Model
{
    use HasFactory, PimpableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'total_price'
    ];

    public function snapshot() 
    {
        return $this->hasOne('App\Models\Snapshot', 'order_id');
    }

    public function ticket() 
    {
        return $this->hasOne('App\Models\Ticket', 'order_id');
    }

    public function user() 
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function payments() 
    {
        return $this->hasMany('App\Models\Payment', 'order_id');
    }
}
