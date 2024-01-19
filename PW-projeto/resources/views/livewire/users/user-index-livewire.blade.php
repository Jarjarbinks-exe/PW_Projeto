<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="search" class="lead">Filter</label>
                <input type="text" wire:model.live="search" class="form-control" id="search">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="department" class="lead">Department</label>
                <select wire:model.live="department" class="form-control" name="department" id="department">
                    <option value=""></option>
                    <option value="1">Contabilidade</option>
                    <option value="2">Marketing</option>
                    <option value="3">Desenvolvimento</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <table class="table table-striped table-hover" style="background-color: white;">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @can('create', \App\Models\User::class)
                    <tr>
                        <td colspan="3" class="text-right">
                            <a href="{{ route('users.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus fa-fw mr-2"></i>Add User
                            </a>
                        </td>
                    </tr>
                @endcan

                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ url('/users/'.$user->id) }}" class="btn btn-info">
                                <i class="fa fa-info-circle fa-fw mr-2"></i>Details
                            </a>
                            <a href="{{ url('/users/'.$user->id.'/edit') }}" class="btn btn-warning">
                                <i class="fa fa-edit fa-fw mr-2"></i>Edit
                            </a>
                            <form action="{{ url('/users/'.$user->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash fa-fw mr-2"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- $users->links('pagination::bootstrap-4') --}}
</div>
