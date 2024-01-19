@extends('layouts.autenticado')

@section('main-content')
    <div class="container mt-5">
        <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="username">Nome:</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $user->username) }}">
                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Nova Password:</label>
                <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-success btn-lg">Guardar Modificações</button>
        </form>

        <div class="mt-4">
            <h4>Existing Permissions:</h4>
            @if(count($user->permissions) > 0)
                <table class="table" style="background-color: white;">
                    <thead>
                    <tr>
                        <th>Permission</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->permissions as $permission)
                        <tr>
                            <td>{{ $permission->value }}</td>
                            <td>
                                <form action="{{ route('users.destroyPermission', ['user' => $user, $permission->id]) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No existing permissions.</p>
            @endif
        </div>

        <div class="mt-4">
            <h4>Add Permissions:</h4>
            @if(count(\App\Services\PermissionService::getUnownedPermissions($user)) > 0)
                <table class="table" style="background-color: white;">
                    <thead>
                    <tr>
                        <th>Permission</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Services\PermissionService::getUnownedPermissions($user) as $permission)
                        <tr>
                            <td>{{ $permission->value }}</td>
                            <td>
                                <form action="{{ route('users.createPermission', ['user' => $user, $permission->id]) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="btn btn-success">Add</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No additional permissions available to add.</p>
            @endif
        </div>

        <div class="mt-4">
            <h4>Belonging Departments:</h4>
            @if(count($user->departments) > 0)
                <table class="table" style="background-color: white;">
                    <thead>
                    <tr>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->departments as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>
                                <form action="{{ route('users.removeDepartment', ['user' => $user, $department->id]) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No belonging departments.</p>
            @endif
        </div>

        <div class="mt-4">
            <h4>Add Department:</h4>
            @if(count(\App\Services\DepartmentService::getUnownedDepartments($user)) > 0)
                <table class="table" style="background-color: white;">
                    <thead>
                    <tr>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Services\DepartmentService::getUnownedDepartments($user) as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>
                                <form action="{{ route('users.createDepartment', ['user' => $user, $department->id]) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="btn btn-success">Add</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No additional departments available to add.</p>
            @endif
        </div>
    </div>
@endsection
