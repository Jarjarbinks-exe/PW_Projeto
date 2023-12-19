<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Services\UserService;

class DepartmentAPIAccessTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_index(): void
    {
        $user = User::create([
            'username' => 'admin',
            'password' => '123',
            'email' => Str::random(8),
        ]);

        $token = $user->createToken('test_negativo', ['aaaa']);

        $plainTextToken = $token->plainTextToken;

        if (UserService::getIsAdmin($user)) {
            $response = $this->get(
                '/api/departments',
                [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $plainTextToken
                ]
            );
            $response->assertStatus(200);
        } else {
            $response = $this->get(
                '/api/departments',
                [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $plainTextToken
                ]
            );
            $response->assertStatus(403);
        }
    }

    public function test_store_ok()
    {
        $user = User::create([
            'username' => 'admin',
            'password' => '123',
            'email' => Str::random(8),
        ]);

        $token = $user->createToken('test_store_ok', ['departments:create']);
        $plainTextToken = $token->plainTextToken;

        $data = [
            'name' => 'departamentoTeste',
        ];

        // Create the new department
        $response = $this->post('/api/departments', $data, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $plainTextToken
        ]);
        $response->assertStatus(201);
    }


    public function test_update_ok()
    {
        $user = User::create([
            'username' => 'admin',
            'password' => '123',
            'email' => Str::random(8),
        ]);

        $token = $user->createToken('test_update_ok', ['departments:update']);
        $plainTextToken = $token->plainTextToken;

        $department = Department::create([
            'name' => 'Old department',
        ]);

        $data = [
            'name' => 'New department',
        ];

        $response = $this->put('/api/departments/' . $department->id, $data, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $plainTextToken
        ]);

        $response->assertStatus(200);

        $department = Department::findOrFail($department->id);
        $this->assertEquals('New department', $department->name);
    }

    public function test_destroy_ok()
    {
        $user = User::create([
            'username' => 'admin',
            'password' => '123',
            'email' => Str::random(8),
        ]);

        $token = $user->createToken('test_destroy_ok', ['departments:destroy']);
        $plainTextToken = $token->plainTextToken;

        $department = Department::create([
            'name' => 'Department to delete',
        ]);

        $response = $this->delete('/api/departments/' . $department->id, [], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $plainTextToken
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }


    public function test_ok()
    {
        $user = User::create([
            'username' => 'admin',
            'password' => '123',
            'email' => Str::random(8),
        ]);
        $token = $user->createToken('test_positivo', ['departments:show']);
        $plainTextToken = $token->plainTextToken;

        $isAdmin = UserService::getIsAdmin($user);

        if ($isAdmin) {
            $response = $this->get(
                '/api/departments',
                [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $plainTextToken
                ]
            );
            $response->assertStatus(200);
        } else {
            $response = $this->get(
                '/api/departments',
                [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $plainTextToken
                ]
            );
            $response->assertStatus(403);
        }
    }


}
