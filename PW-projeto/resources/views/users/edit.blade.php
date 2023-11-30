@extends('layouts.autenticado')

@section('main-content')

    <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
        @method('PUT')
        @csrf
        Nome: <input type="text" name="username" id="" class="form-control" value="{{ old('username', $user->username) }}"><br>
        @error('username') <span class="text-danger">{{ $message }}</span><br>@enderror
        Email: <input type="email" name="email" id="" class="form-control" value="{{ old('email', $user->email) }}"><br>
        @error('email') <span class="text-danger">{{ $message }}</span><br>@enderror
        <button type="submit" class="btn btn-success btn-lg">Guardar Modificações</button>

    </form>
    <p>Existing Permissions:</p>
    @foreach($user->permissions as $permission)
        <li> Permission: {{$permission->value}}
            <form action="{{ route('users.destroyPermission', ['user' => $user, $permission->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">delete</button>
            </form>
        </li>
    @endforeach
    <p>Add Permissions:</p>
    @foreach(\App\Services\PermissionService::getUnownedPermissions($user) as $permission)
        <li> Permission: {{$permission->value}}
            <form action="{{ route('users.createPermission', ['user' => $user, $permission->id]) }}" method="post">
                @csrf
                @method('GET')
                <button type="submit">Add</button>
            </form>
        </li>
    @endforeach


@endsection
