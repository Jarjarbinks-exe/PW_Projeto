<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tests\TestCase;

class DocumentAPIAccessTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_index(): void
    {
        $response = $this->get(
            '/api/documents',
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
            '/api/documents',
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
        $token = $user->createToken('test_positivo', ['documents:list']);
        $plainTextToken = $token->plainTextToken;
        $response = $this->get(
            '/api/documents',
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

        $document = Document::create([
            'user_id' => 1,
        ]);
        $token = $user->createToken('test_positivo', ['documents:show']);
        $plainTextToken = $token->plainTextToken;
        $response = $this->get(
            '/api/documents/' . $document->id,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $plainTextToken
            ]
        );
        $response->assertStatus(200);

    }

    public function test_can_update() {
        $user = User::create([
            'username' => 'algo',
            'email' => Str::random(8) . '@example.com',
            'password' => '12345678',
        ]);


        $token = $user->createToken('test_positivo', ['documents:update']);
        $plainTextToken = $token->plainTextToken;

        $response = $this->put(
            '/api/documents/4' ,
            [
                'file_path' => 'aaaaaaaaaaaaaaaaa'
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $plainTextToken,
            ]
        );
        $response->assertStatus(200);

    }

    public function test_can_create() {
        $user = User::create([
            'username' => 'algo',
            'email' => Str::random(8) . '@example.com',
            'password' => '12345678',
        ]);


        $token = $user->createToken('test_positivo', ['documents:create']);
        $plainTextToken = $token->plainTextToken;

        $response = $this->post(
            '/api/documents' ,
            [
                'user_id' => 1,
                'file_path' => 'aaaaaaaaa'
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $plainTextToken,
            ]
        );
        Log::info('Request data:', $response->json());
        $response->assertStatus(201);
    }

    public function test_can_destroy() {
        $user = User::create([
            'username' => 'algo',
            'email' => Str::random(8) . '@example.com',
            'password' => '12345678',
        ]);
        Auth::login($user);
        $token = $user->createToken('test_positivo', ['documents:destroy']);
        $plainTextToken = $token->plainTextToken;
        $random_document_id = fake()->numberBetween(1, 20);

        $response = $this->delete(
            '/api/documents/' . $random_document_id,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $plainTextToken,
            ]
        );

        Log::info('Request data do destroy user!:', $response->json());
        $response->assertStatus(200);

    }

}
