@extends('layouts.autenticado')

@section('main-content')
    <div class="container mt-5">
        <h1>User Details</h1>

        <div class="card">
            <div class="card-body">
                <p><strong>Name:</strong> {{ $user->username }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>

                <div class="permissions-section">
                    <p><strong>Permissions:</strong></p>
                    <ul>
                        @forelse($user->permissions as $permission)
                            <li>{{ $permission->value }}</li>
                        @empty
                            <li>No permissions found.</li>
                        @endforelse
                    </ul>
                </div>

                <div class="departments-section">
                    <p><strong>Departments:</strong></p>
                    <ul>
                        @forelse($user->departments as $department)
                            <li>{{ $department->name }}</li>
                        @empty
                            <li>No departments found.</li>
                        @endforelse
                    </ul>
                </div>

                <a href="{{ url('/users/'.$user->id.'/edit') }}" class="btn btn-warning mt-3">Edit</a>
                <a href="{{ url('/users') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection
