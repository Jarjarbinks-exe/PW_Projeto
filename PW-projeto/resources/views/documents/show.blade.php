
@extends('layouts.autenticado')

@section('main-content')
    <h1>User details</h1>
    <p>ID: {{ $document->id }}</p>
    <p>Created_At: {{ $document->created_at }}</p>
    <p>Updated_At: {{ $document->updated_at }}</p>
    <p>User_ID: {{ $document->user_id }}</p>
    <a href="{{ url('/document/'.$document->id.'/edit') }}">edit</a>
    <p>User_ID: {{ $document->user_id }}</p>
@endsection

