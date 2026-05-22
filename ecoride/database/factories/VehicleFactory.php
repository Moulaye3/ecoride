<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    public function definition(): array
{
    return [
        'brand' => fake()->randomElement(['Tesla', 'Renault', 'Peugeot', 'Toyota']),
        'model' => fake()->randomElement(['Model 3', 'Clio', '308', 'Yaris']),
        'color' => fake()->colorName(),
        'energy' => fake()->randomElement(['electric', 'hybrid', 'thermal']),
        'plate' => strtoupper(fake()->bothify('??-###-??')),
        'first_registration_date' => fake()->dateTimeBetween('-10 years'),
        'seats' => fake()->numberBetween(2, 5),
    ];
}
}
