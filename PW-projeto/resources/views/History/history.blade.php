@extends('layouts.app')

@section('content')
    <h1>History</h1>
    <table>
        <thead>
        <tr>
            <th>Action</th>
            <th>Update date</th>
            <th>User</th>
        </tr>
        </thead>
        <tbody>
        @foreach($history as $entry)
            <tr>
                <td>{{ $entry->action }}</td>
                <td>{{ $entry->created_at }}</td>
                <td>{{ $entry->user_name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
