<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Permissions;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Operações do CRUD
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        $users = User::orderBy('username')->paginate(25);
        return view(
            'users.index',
            [
                'users' => $users
            ]
        );
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function create()
    {
        return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {
        ddd($request);
        $user = User::create([
            'username' => $request['username'],
            'password' => $request['password'],
            'email' => $request['email'],
            'email_verified_at' => now(),
            'remember token' => null,
            'created_at' => now(),
            'modified_at' => now(),
        ]);
        return redirect()
            ->route('users', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->toDTO()->toArray());
        return redirect()
            ->route('users.show', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        # TODO verificar se o user está associado a um documento, se sim a foreign key = null
        User::destroy($user->id);
        return redirect()
            ->route('users.index');
    }

    public function destroyPermission(User $user, Permissions $permission) {

        $user->permissions()->detach($permission->id);
        return redirect()
            ->route('users.edit', compact('user'));
    }

    public function createPermission(User $user, Permissions $permission) {

        $user->permissions()->attach($permission->id);
        return redirect()
            ->route('users.edit', compact('user'));
    }
}

