<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function departureRoutes()
    {
        return $this->hasMany(Route::class, 'departure_city_id');
    }

    public function arrivalRoutes()
    {
        return $this->hasMany(Route::class, 'arrival_city_id');
    }
}
