<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'pseudo',
        'email',
        'password',
        'role',
        'credits',
        'avatar_url',
        'bio'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'credits' => 'integer',
    ];

    // === RELATIONS ===

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function preferences()
    {
        return $this->hasOne(Preference::class);
    }

    // Trajets en tant que conducteur
    public function ridesAsDriver()
    {
        return $this->hasMany(Ride::class, 'driver_id');
    }

    // Trajets en tant que passager
    public function ridesAsPassenger()
    {
        return $this->belongsToMany(Ride::class, 'ride_passengers', 'passenger_id', 'ride_id')
            ->withPivot('status', 'joined_at');
    }

    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'driver_id');
    }

    // Méthodes utiles
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isEmployee()
    {
        return $this->role === 'employee';
    }
}