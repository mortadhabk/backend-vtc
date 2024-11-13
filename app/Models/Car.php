<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'seating_capacity',
        'color',
        'image_url',
        'price_per_km',
    ];

    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
