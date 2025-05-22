<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase; // Ensures a fresh database state for each test

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }




    public function test_a_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'contact_number' => '1234567890', // Add this field

            'address' => '123 Main Street', // Add the required field

        ]);

        $response->assertRedirect('/home'); // Adjust as needed

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }
    /** @test */
public function a_user_can_login()
{
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirect('/home'); // Adjust as needed
    $this->assertAuthenticatedAs($user);
}

public function test_admin_can_login_successfully()
{
    // Create an admin user
    $admin = User::factory()->create([
        'email' => 'user@gmail.com',
        'password' => bcrypt('user@gmail.com'),
        'isAdmin' => 1,
    ]);

    // Send login request
    $response = $this->post('/login', [
        'email' => 'user@gmail.com',
        'password' => 'user@gmail.com',
    ]);

    // Assert login was successful
    $response->assertRedirect('/home'); // Adjust route accordingly
    $this->assertAuthenticatedAs($admin);
}

/** @test */
}