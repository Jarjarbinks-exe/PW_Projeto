<?php

@extends('layouts.app')

@section('content')
    <h1>Users List</h1>
    <a href="{{ url('/users/create') }}">Create a new user</a>
    <table>
        <thead>
        <tr>
            <th>name</th>
            <th>email</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ url('/users/'.$user->id) }}">details</a>
                    <a href="{{ url('/users/'.$user->id.'/edit') }}">edit</a>
                    <form action="{{ url('/users/'.$user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

