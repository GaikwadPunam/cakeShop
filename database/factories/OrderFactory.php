<?php

namespace Database\Factories;
use App\Models\Order;
use App\Models\User;
use App\Models\cake;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Creates a user when generating an order entry
            'user_name' => $this->faker->name,
            'address' => $this->faker->address,
            'contact_number' => $this->faker->phoneNumber,
            'cake_id' => Cake::factory(), // Creates a cake when generating an order entry
            'cake_name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 5, 50),
            'image' => $this->faker->imageUrl(200, 200, 'food'),
            'payment_status' => 'cash on delivery',
            'delivery_status' => 'processing',

        ];
    }
}
