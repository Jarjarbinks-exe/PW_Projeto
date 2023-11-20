@extends('layouts.autenticado')

@section('main-content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>name</th>
                    <th>email</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                <a class="p-5" href="{{ route('users.create') }}">create</a>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ url('/users/'.$user->id) }}">details</a>
                            <a href="{{ url('/users/'.$user->id.'/edit') }}">edit</a>
                            <form action="{{ url('/users/'.$user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $users->links('pagination::bootstrap-4') }}
</div>
@endsection

