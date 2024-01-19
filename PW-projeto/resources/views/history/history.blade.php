@extends('layouts.autenticado')

@section('main-content')
    <div class="container mt-5">
        <h1>History</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" style="background: linear-gradient(to right, #ffffff, #f0f0f0);">
                <thead class="thead-dark">
                <tr>
                    <th>Action</th>
                    <th>Update Date</th>
                    <th>User</th>
                </tr>
                </thead>
                <tbody>
                @forelse($history as $entry)
                    <tr>
                        <td>{{ $entry->type }}</td>
                        <td>{{ date_format($entry->created_at, 'Y-m-d') }}</td>
                        <td>{{ $entry->owner }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No history available.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <a href="{{ url('/documents') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
