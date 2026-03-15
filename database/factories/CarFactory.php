<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\CarOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(50),
            'description' => fake()->text(300),
            'price' => fake()->randomFloat(2, 100000, 9999999),
            'photo_url' => fake()->url(),
            'contacts' => fake()->phoneNumber(),
        ];
    }

    public function withOptions(): Factory
    {
        return $this->afterCreating(function (Car $car) {
            CarOption::factory()->create([
                'car_id' => $car->getKey(),
            ]);
        });
    }
}
