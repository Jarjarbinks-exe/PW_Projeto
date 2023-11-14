<?php

@extends('layouts.app')

@section('content')
    <h1>User details</h1>
    <p>name: {{ $user->name }}</p>
    <p>email: {{ $user->email }}</p>
    <a href="{{ url('/users/'.$user->id.'/edit') }}">edit</a>
@endsection


