
@extends('layouts.autenticado')

@section('main-content')
    <h1>User details</h1>
    <p>name: {{ $user->username }}</p>
    <p>email: {{ $user->email }}</p>
    <p>permissions:</p>
        @foreach($user->permissions as $permissions)
            <li>Permission: {{$permissions->value}}</li>
        @endforeach
    <a href="{{ url('/users/'.$user->id.'/edit') }}">edit</a>
@endsection


