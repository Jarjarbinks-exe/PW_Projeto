@extends('layouts.autenticado')

@section('main-content')
    <div class="container mt-5">
        <h1>Create New User</h1>

        <form action="{{ route('users.store') }}" method="post">
            @method('POST')
            @csrf

            <div class="form-group">
                <label for="username">Nome:</label>
                <input type="text" name="username" id="username" class="form-control" value="">
                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="" required>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" value="">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-success btn-lg">Create User</button>
        </form>

        <div class="mt-3">
            <a href="{{ url('/users') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection

