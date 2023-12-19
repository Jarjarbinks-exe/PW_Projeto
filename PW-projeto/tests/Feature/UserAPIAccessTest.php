<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserAPIAccessTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_index(): void
    {
        $response = $this->get(
            '/api/users',
            [
                'Accept' => 'application/json',
            ]
        );
        $response->assertStatus(401);

        $user = User::create([
            'username' => 'admin',
            'email' => Str::random(8),
            'password' => '12345678',
        ]);
        $token = $user->createToken('test_negativo', ['aaaa']);
        $plainTextToken = $token->plainTextToken;

        $response = $this->get(
            '/api/users',
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $plainTextToken
            ]
        );
        $response->assertStatus(403);
    }

    public function test_ok()
    {
        $user = User::create([
            'username' => 'admin',
            'email' => Str::random(8),
            'password' => '123',
        ]);
        $token = $user->createToken('test_positivo', ['users:list']);
        $plainTextToken = $token->plainTextToken;
        $response = $this->get(
            '/api/users',
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $plainTextToken
            ]
        );
        $response->assertStatus(200);
    }

    public function test_can_view() {
        $user = User::create([
            'username' => 'admin',
            'email' => Str::random(8),
            'password' => '12345678',
        ]);
        $token = $user->createToken('test_positivo', ['users:show']);
        $plainTextToken = $token->plainTextToken;

        $response = $this->get(
            '/api/users/' . $user->id,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $plainTextToken
            ]
        );
        $response->assertStatus(200);

    }

    public function test_can_create() {
        $user = User::create([
            'username' => 'algo',
            'email' => Str::random(8) . '@example.com', // Use a unique email for each test
            'password' => '12345678',
        ]);
        $token = $user->createToken('test_positivo', ['users:create']);
        $plainTextToken = $token->plainTextToken;

        $response = $this->post(
            '/api/users' ,
            [
                'username' => 'joaquim',
                'password' => '12345678',
                'email' => Str::random(8) . '@example.com', // Use a unique email for each test
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $plainTextToken,
            ]
        );
        Log::info('Request data:', $response->json());
        $response->assertStatus(201);
    }

    public function test_can_update() {
        $user = User::create([
            'username' => 'algo',
            'email' => Str::random(8) . '@example.com', // Use a unique email for each test
            'password' => '12345678',
        ]);

        $token = $user->createToken('test_positivo', ['users:update']);
        $plainTextToken = $token->plainTextToken;

        $response = $this->put(
            '/api/users/4' ,
            [
                'username' => 'TesteUpdate',
                'password' => '12345678',
                'email' => Str::random(8) . '@example.com', // Use a unique email for each test
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $plainTextToken,
            ]
        );
        $response->assertStatus(200);

    }

    public function test_can_destroy() {
        $user = User::create([
            'username' => 'algo',
            'email' => Str::random(8) . '@example.com', // Use a unique email for each test
            'password' => '12345678',
        ]);
        Auth::login($user);
        $token = $user->createToken('test_positivo', ['users:destroy']);
        $plainTextToken = $token->plainTextToken;
        $random_user_id = fake()->numberBetween(1, 200);

        $response = $this->delete(
            '/api/users/' . $random_user_id,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $plainTextToken,
            ]
        );

        Log::info('Request data do destroy user!:', $response->json());
        $response->assertStatus(200);

    }


}
