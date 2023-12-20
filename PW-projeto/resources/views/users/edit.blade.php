@extends('layouts.autenticado')

@section('main-content')

    <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
        @method('PUT')
        @csrf
        <div>
            <label for="username">Nome:</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $user->username) }}">
            @error('username') <span class="text-danger">{{ $message }}</span><br> @enderror
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
            @error('email') <span class="text-danger">{{ $message }}</span><br> @enderror
        </div>

        <div>
            <label for="password">Nova Password:</label>
            <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
            @error('password') <span class="text-danger">{{ $message }}</span><br> @enderror
        </div>

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
    <p> Belonging Departments: </p>
    @foreach($user->departments as $department)
        <li> Department: {{$department->name}}
            <form action="{{ route('users.removeDepartment', ['user' => $user, $department->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">delete</button>
            </form>
        </li>
    @endforeach
    <p>Add Department: </p>
    @foreach(\App\Services\DepartmentService::getUnownedDepartments($user) as $departments)
        <li> Department: {{$departments->name}}
            <form action="{{ route('users.createDepartment', ['user' => $user, $departments->id]) }}" method="post">
                @csrf
                @method('GET')
                <button type="submit">Add</button>
            </form>
        </li>
    @endforeach
@endsection
