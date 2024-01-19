@extends('layouts.autenticado')

@section('main-content')
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
                <td>{{ $entry->type }}</td>
                <td>{{ date_format($entry->created_at, 'Y-m-d') }}</td>
                <td>{{ $entry->owner }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
