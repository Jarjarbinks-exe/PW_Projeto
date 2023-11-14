<?php

@extends('layouts.app')

@section('content')
    <h1>Create a new user</h1>
    <form action="{{ url('/users') }}" method="post">
        @csrf
        <label for="name">name:</label>
        <input type="text" name="name" required><br>
        <label for="email">email:</label>
        <input type="email" name="email" required><br>
        <label for="password">password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Create user</button>
    </form>
@endsection

