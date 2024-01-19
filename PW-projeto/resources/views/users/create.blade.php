@extends('layouts.autenticado')

@section('main-content')
    <h1>Create a new user</h1>
    <form action="{{ route('users.store') }}" method="post">
        @method('POST')
        @csrf
        Nome: <input type="text" name="username" id="" class="form-control" value=""><br>
        @error('username') <span class="text-danger">{{ $message }}</span><br>@enderror
        Email: <input type="email" name="email" id="" class="form-control" value="" required><br>
        @error('email') <span class="text-danger">{{ $message }}</span><br>@enderror
        Password: <input type="text" name="password" id="" class="form-control" value=""><br>
        @error('password') <span class="text-danger">{{ $message }}</span><br>@enderror
        <button type="submit" class="btn btn-success btn-lg">Criar User</button>
    </form>
@endsection

