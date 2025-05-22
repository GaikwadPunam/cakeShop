<?php

namespace Database\Factories;
use App\Models\cake;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\cake>
 */
class CakeFactory extends Factory
{
    protected $model = cake::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 5, 50),
            'image' => 'public/cake/sample.jpg'

        ];
    }
}
