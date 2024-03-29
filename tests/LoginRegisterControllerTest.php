<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginRegisterControllerTest extends TestCase
{
    /**
     * Test the register method.
     *
     * @return void
     */
    public function testRegister()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->json('POST', '/register', $data);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                // Add more assertions based on your response structure
            ]);
    }

    /**
     * Test the login method.
     *
     * @return void
     */
    public function testLogin()
    {
        $data = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $response = $this->json('POST', '/login', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                // Add more assertions based on your response structure
            ]);
    }

    /**
     * Test the logout method.
     *
     * @return void
     */
    public function testLogout()
    {
        // Assuming you have a logged-in user for testing logout
        $user = \App\Models\User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', '/logout');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                // Add more assertions based on your response structure
            ]);
    }
}
