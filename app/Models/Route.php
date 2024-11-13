<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Route extends Model
{
    use HasFactory;
    protected $fillable = [
        'departure_city_id',
        'arrival_city_id',
        'car_id',
        'distance_km',
        'duration',
    ];

    public function departureCity()
    {
        return $this->belongsTo(City::class, 'departure_city_id');
    }

    public function arrivalCity()
    {
        return $this->belongsTo(City::class, 'arrival_city_id');
    }


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
