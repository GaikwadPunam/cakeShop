<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

use Illuminate\Support\Facades\Validator;

use App\Http\Requests\cakeCreateRequest;

class CakeCreateRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function it_passes_validation_with_valid_data()
    {
        $validData = [
            'name' => 'Chocolate Cake',
            'description' => 'Delicious chocolate cake',
            'price' => 19.99,
            'image' => 'test.jpg', // Simulated image filename (only used for validation, not upload)
        ];

        $this->assertFalse($this->validateRequest($validData));

    
    }

    /** @test */
    public function it_fails_validation_when_name_is_missing()
    {
        $this->withoutMiddleware();

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);



        $invalidData = [
            'description' => 'Tasty vanilla cake',
            'price' => 15.99,
            'image' => 'test.jpg',
        ];

        $response = $this->postJson(route('cake.store'), $invalidData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);

    }

    /** @test */
    public function it_fails_validation_when_price_is_not_numeric()
    {
        $this->withoutMiddleware();

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);



        $invalidData = [
            'name' => 'Strawberry Cake',
            'description' => 'Sweet and fresh',
            'price' => 'free', // Invalid price
            'image' => 'test.jpg',
        ];

        $response = $this->postJson(route('cake.store'), $invalidData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['price']);
    }

    /** @test */
    public function it_fails_validation_when_image_is_missing()
    {

        $this->withoutMiddleware();

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);



        $invalidData = [
            'name' => 'Lemon Cake',
            'description' => 'Citrusy and light',
            'price' => 10.50,
        ];

        $response = $this->postJson(route('cake.store'), $invalidData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['image']);
    }
}

