<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
    $users = \App\Models\User::where('role', '!=', 'visitor')->get();

    foreach ($users as $user) {
        \App\Models\Vehicle::factory(1)->create(['user_id' => $user->id]);
        }
    }
}
