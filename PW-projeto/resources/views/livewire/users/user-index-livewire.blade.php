<div>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <p class="lead">Filtro</p>
                <input type="text" wire:model.live="search" class="form-control">
            </div>
            <div class="col-4">
                <p class="lead">Departamento</p>


                <select wire:model.live="department" class="form-control" name="department" id="department">
                    <option value=""></option>
                    <option value="1">Contabilidade</option>
                    <option value="2">Marketing</option>
                    <option value="3">Desenvolvimento</option>
                </select>
            </div>
        </div>

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
                    @can('create', \App\Models\User::class)
                        <p class="text-right">
                            <a href="{{ route('users.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus fa-fw mr-2"></i>Adicionar User
                            </a>
                        </p>
                    @endcan

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
       {{-- $users->links('pagination::bootstrap-4') --}}
    </div>
</div>
