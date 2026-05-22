<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable = [
        'driver_id', 'vehicle_id', 'departure_city', 'arrival_city',
        'departure_address', 'arrival_address', 'departure_datetime',
        'arrival_datetime', 'price', 'seats_available', 'status'
    ];

    protected $casts = [
        'departure_datetime' => 'datetime',
        'arrival_datetime' => 'datetime',
        'price' => 'decimal:2',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function passengers()
    {
        return $this->belongsToMany(User::class, 'ride_passengers', 'ride_id', 'passenger_id')
                    ->withPivot('status', 'joined_at');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}