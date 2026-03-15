<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarOption>
 */
class CarOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'car_id' => Car::query()->inRandomOrder()->first() ?? Car::factory()->create(),
            'brand' => fake()->word(),
            'model' => fake()->word(),
            'year' => fake()->numberBetween(1990, 2026),
            'body' => fake()->text(200),
            'mileage' => fake()->numberBetween(100, 1000),
        ];
    }
}
