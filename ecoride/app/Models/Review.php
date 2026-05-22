<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RidePassenger extends Pivot
{
    protected $table = 'ride_passengers';

    protected $casts = [
        'joined_at' => 'datetime',
    ];
}