<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\cake;
use App\Models\Cart;
use App\Models\Order;



class CartControllerTest extends TestCase
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






    
        public function test_authenticated_user_can_add_to_cart()
        {
            // Create a user
            $user = User::factory()->create();
            
            // Create a cake
            $cake = cake::factory()->create();
    
            // Act as the authenticated user
            $response = $this->actingAs($user)->post(route('add_cart', $cake->id));
    
            // Assert the cake is added to the cart
            $this->assertDatabaseHas('carts', [
                'user_id' => $user->id,
                'cake_id' => $cake->id,
            ]);
    
            $response->assertRedirect()->with('success', 'Cake added to cart');
        }
    
        public function test_guest_user_cannot_add_to_cart()
        {
            $cake = cake::factory()->create();
    
            $response = $this->post(route('add_cart', $cake->id));
    
            $response->assertRedirect(route('login'));
        }
    
        public function test_authenticated_user_can_view_cart()
        {
            $user = User::factory()->create();
            $cake = cake::factory()->create();
            $cart = Cart::factory()->create(['user_id' => $user->id, 'cake_id' => $cake->id]);
    
            $response = $this->actingAs($user)->get(route('cart'));
    
            $response->assertStatus(200);
            $response->assertViewIs('cart');
            $response->assertViewHas('data');
        }
    
    
        public function test_authenticated_user_can_view_orders()
        {
            $user = User::factory()->create();
            $order = Order::factory()->create(['user_id' => $user->id]);
    
            $response = $this->actingAs($user)->get(route('my_order'));
    
            $response->assertStatus(200);
            $response->assertViewIs('my_order');
            $response->assertViewHas('order');
        }
    




















    public function test_cash_order_places_order_and_clears_cart()
    {
        // 1. Create a fake user
        $user = User::factory()->create();
        $this->actingAs($user);

        // 2. Mock authentication

        // 3. Create cart items for the user
        $cartItem = Cart::factory()->create([
            'user_id' => $user->id,
            'user_name' => 'John Doe',
            'address' => '123 Street',
            'contact_number' => '123456789',
            'cake_name' => 'Chocolate Cake',
            'cake_id' => 1,
            'price' => 20.00,
            'image' => 'cake.jpg',
        ]);

        // 4. Call the method
        $response = $this->actingAs($user)->get(route('cash.order'));

        // 5. Assertions
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'user_name' => 'John Doe',
            'cake_name' => 'Chocolate Cake',
            'price' => 20.00,
            'payment_status' => 'cash on delivery',
            'delivery_status' => 'processing',
        ]);

        $this->assertDatabaseMissing('carts', ['id' => $cartItem->id]); // Ensure cart is deleted

        $response->assertRedirect()->assertSessionHas('message', 'we have  your order.  we will contact with you soon');
    }

    public function it_does_not_cancel_a_delivered_order()
    {
        // Arrange: Create a delivered order
        $order = Order::factory()->create(['delivery_status' => 'delivered']);

        // Act: Call the cancel_order method
        $response = $this->get(route('cancel_order', $order->id));

        // Assert: Order status remains unchanged
        $this->assertEquals('delivered', $order->fresh()->delivery_status);
        $response->assertSessionHas('error', 'Order is already delivered and cannot be canceled.');
    }

    /** @test */
    public function it_cancels_an_undelivered_order()
    {
        // Arrange: Create an undelivered order
        $order = Order::factory()->create(['delivery_status' => 'pending']);

        // Act: Call the cancel_order method
        $response = $this->get(route('cancel_order', $order->id));

        // Assert: Order status is updated
        $this->assertEquals('you cancel the order', $order->fresh()->delivery_status);
    }


    public function test_it_marks_an_order_as_delivered()
    {
        // Arrange: Create a test order
        $order = Order::factory()->create([
            'delivery_status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        // Act: Call the delivered method
        $response = $this->get(route('delivered', $order->id));

        // Refresh order from DB
        $order->refresh();

        // Assert: Check if the values are updated
        $this->assertEquals('delivered', $order->delivery_status);
        $this->assertEquals('paid', $order->payment_status);
        $response->assertRedirect();
    }
}


