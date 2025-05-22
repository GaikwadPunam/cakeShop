<?php

namespace Tests\Feature;
use App\Models\cake;
use App\Models\User;
use App\Models\Order;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;






class CakeControllerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */

    /**
     * A basic feature test example.
     */

    public function test_example(): void
    {
        $response = $this->get('/');

                    $response->assertStatus(200);
    }



    public function test_index_displays_cakes()
    {
        $this->withoutMiddleware();

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        


        $response = $this->get(route('cake.index'));
    
        $response->assertStatus(200);
        $response->assertViewHas('allCakes');
    }

    public function test_store_creates_a_cake()
    {
        Storage::fake('public');

        $this->withoutMiddleware();

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
    


        $image = UploadedFile::fake()->image('cake.jpg');

        $data = [
            'name' => 'Chocolate Cake',
            'description' => 'Delicious chocolate cake',
            'price' => 20.50,
            'image' => $image,
        ];

        $response = $this->post(route('cake.store'), $data);

        $response->assertRedirect(route('cake.index'));
        $this->assertDatabaseHas('cakes', ['name' => 'Chocolate Cake']);
        Storage::disk('public')->assertExists('cake/' . $image->hashName());
    }

    public function test_update_modifies_a_cake()
    {
        Storage::fake('public');
        $this->withoutMiddleware();

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $cake = cake::factory()->create();

        $newImage = UploadedFile::fake()->image('new_cake.jpg');

        $updateData = [
            'name' => 'Updated Cake',
            'description' => 'Updated description',
            'price' => 25.99,
            'image' => $newImage,
        ];



        
        $response = $this->put(route('cake.update', $cake->id), $updateData);

        $response->assertRedirect(route('cake.index'));
        $this->assertDatabaseHas('cakes', ['name' => 'Updated Cake']);
        Storage::disk('public')->assertExists('cake/' . $newImage->hashName());
    }

    public function test_destroy_deletes_a_cake()
    {
        $this->withoutMiddleware();

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $cake = cake::factory()->create();

        $response = $this->delete(route('cake.delete', $cake->id));

        $response->assertRedirect(route('cake.index'));
        $this->assertDatabaseMissing('cakes', ['id' => $cake->id]);
    }



    public function test_admin_view_all_orders()
    {
        $this->withoutMiddleware();

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);


        // Arrange: Create fake orders
        $orders = Order::factory()->count(3)->create();

        // Act: Call the order route
        $response = $this->get(route('cake.order')); // Change route if necessary

        // Assert: Check if the correct view is returned with orders
        $response->assertStatus(200);
        $response->assertViewIs('cake.order');
        $response->assertViewHas('order', function ($viewOrders) use ($orders) {
            return $viewOrders->count() === 3; // Ensure all orders are passed
        });
    }
}




