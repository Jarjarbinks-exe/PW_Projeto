<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Operações do CRUD
    public function __construct()
    {
        $this->authorizeResource(User::class, ['user', 'administrator']);
    }

    public function index()
    {
        $users = User::orderBy('name')->paginate(25);
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UpdateUserRequest $request)
    {
        $user = User::create($request);

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
        User::destroy($user->id);
        return redirect()
            ->route('users');
    }
}

