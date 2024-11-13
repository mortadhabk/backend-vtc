<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'route_id',
        'car_id',
        'departure_datetime',
        'arrival_datetime',
        'additional_info',
        'session_id',
        'payment_status',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
