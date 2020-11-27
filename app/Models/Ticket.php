<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class Ticket extends Model
{
    use HasFactory, PimpableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'bus_name',
        'ticket_amount',
        'seat_position',
        'departure_city',
        'departure_bus_station',
        'departure_date',
        'arrived_city',
        'arrived_bus_station',
        'arrived_date'
    ];

    public function user() 
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}
