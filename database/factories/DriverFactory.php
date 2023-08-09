<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'license_number' => fake()->randomNumber(8),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'status' => fake()->randomElement([0, 1]),
        ];
    }
}
