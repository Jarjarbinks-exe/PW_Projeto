@extends('layouts.autenticado')

@section('main-content')
    <h1>Create a new user</h1>
    <form action="{{ route('users.create') }}" method="post">
        @method('GET')
        @csrf
        Nome: <input type="text" name="username" id="" class="form-control" value="username"><br>
        @error('username') <span class="text-danger">{{ $message }}</span><br>@enderror
        Email: <input type="email" name="email" id="" class="form-control" value="email"><br>
        @error('email') <span class="text-danger">{{ $message }}</span><br>@enderror
        Password: <input type="text" name="password" id="" class="form-control" value="password"><br>
        @error('email') <span class="text-danger">{{ $message }}</span><br>@enderror
        <button type="submit" class="btn btn-success btn-lg">Criar User</button>
    </form>
@endsection

