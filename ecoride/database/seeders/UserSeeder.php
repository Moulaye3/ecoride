<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'pseudo' => 'admin',
            'email' => 'admin@ecoride.fr',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'credits' => 999,
        ]);

        // Employee
        User::create([
            'pseudo' => 'modérateur',
            'email' => 'mod@ecoride.fr',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'credits' => 100,
        ]);

        // Quelques utilisateurs normaux
        User::factory(15)->create();
    }
}