<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text(60),
            'category' => $this->faker->randomElement(['Hardware', 'Software', 'Peripheral']),
            'price' => 10000 * $this->faker->numberBetween(10, 300),
            'stock' => $this->faker->numberBetween(1, 20),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
