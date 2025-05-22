<?php

namespace Database\Factories;
use App\Models\Cart;
use App\Models\User;
use App\Models\cake;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    protected $model = Cart::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Creates a user when generating a cart entry
            'user_name' => $this->faker->name,
            'address' => $this->faker->address,
            'contact_number' => $this->faker->phoneNumber,
            'cake_id' => Cake::factory(), // Creates a cake when generating a cart entry
            'cake_name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 5, 50),
            'image' => $this->faker->imageUrl(200, 200, 'food'),

        ];
    }
}
