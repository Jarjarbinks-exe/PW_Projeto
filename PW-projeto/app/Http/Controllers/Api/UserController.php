<?php

namespace App\Http\Controllers\Api;

use App\Dto\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PHPUnit\TextUI\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->tokenCan('users:list')) {
            abort(403);
        }

        return new UserResourceCollection(User::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->only(['username', 'email', 'password']);
        if (!Auth::user()->tokenCan('users:create')) {
            abort(403);
        }

        // Create the user
        if (User::create(['username' => $requestData['username'],
            'email' => $requestData['email'],
            'password' => $requestData['password']
        ])) {
            return response()->json(['message' => 'User created successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to create user'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $user)
    {
        if (!Auth::user()->tokenCan('users:show')) {
            abort(403);
        }
        try {
            $user = User::findOrFail($user);
            return new UserResource($user);
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json(['message' => 'Não encontrado'], 404);
            }

            return response()->json(['message' => 'Ocorreu um erro de comunicação'], 503);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user)
    {
        if (!Auth::user()->tokenCan('users:update')) {
            abort(403);
        }
        try {
            $user = User::findOrFail($user);
            $userDTO = new UserDTO(
                $request['username'],
                $request['password'],
                $request['email'],
            );
            $user->update($userDTO->toArray());
            return new UserResource($user);
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json(['message' => 'Não encontrado'], 404);
            }

            return response()->json(['message' => 'Ocorreu um erro de comunicação'], 503);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user)
    {
        if (!Auth::user()->tokenCan('users:destroy')) {
            abort(403);
        }
        try {
            $user = User::findOrFail($user);
            User::destroy($user->id);
            return response()->json(['message' => 'Foi encontrado e destruido o User: ' . $user->id]);
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return response()->json(['message' => 'Não encontrado'], 404);
            }

            return response()->json(['message' => 'Ocorreu um erro de comunicação'], 503);
        }

    }
}
