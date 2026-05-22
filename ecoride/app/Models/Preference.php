<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $fillable = [
        'user_id', 'no_smoking', 'no_animals', 'music_level', 'other_preferences'
    ];

    protected $casts = [
        'no_smoking' => 'boolean',
        'no_animals' => 'boolean',
        'other_preferences' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}