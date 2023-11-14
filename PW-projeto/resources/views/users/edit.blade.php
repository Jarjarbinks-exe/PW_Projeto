<?php

@extends('layouts.app')

@section('content')
    <h1>Edit user</h1>
    <form action="{{ url('/users/'.$user->id) }}" method="post">
        @csrf
        @method('put')
        <label for="name">name:</label>
        <input type="text" name="name" value="{{ $user->name }}" required><br>
        <label for="email">email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required><br>
        <button type="submit">Update user</button>
    </form>
@endsection

