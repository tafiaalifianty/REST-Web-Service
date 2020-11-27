<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;

class Payment extends Model
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
        'payment_amount',
        'payment_proof',
        'bank_name',
        'bank_account'
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
