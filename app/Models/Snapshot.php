<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class Snapshot extends Model
{
    use HasFactory, PimpableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}
