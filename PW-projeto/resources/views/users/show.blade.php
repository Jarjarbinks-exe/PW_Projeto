
@extends('layouts.autenticado')

@section('main-content')
    <h1>User details</h1>
    <p>Name: {{ $user->username }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Permissions:</p>
        @foreach($user->permissions as $permissions)
            <li>Permission: {{$permissions->value}}</li>
        @endforeach
    <p>Department: </p>
        @foreach($user->departments as $department)
            <li>
                {{$department->name}} </li>
        @endforeach
    <a href="{{ url('/users/'.$user->id.'/edit') }}">edit</a>
@endsection


