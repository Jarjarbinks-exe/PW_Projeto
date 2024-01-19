@extends('layouts.autenticado')

@section('main-content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <a class="p-5" href="{{ route('documents.create') }}">upload file</a>
                    @foreach($documents as $document)
                        <tr>
                            <td>{{ $document->id }}</td>
                            <td>{{ $document->created_at }}</td>
                            <td>
                                <a href="{{ url('/documents/'.$document->id.'/history') }}">details</a>
                                @if(!$document->password || session('valid_response'))
                                    <a href="{{ asset('storage/' . $document->file_path) }}">View</a>
                                    <a href="{{ url('/documents/'.$document->id.'/edit') }}">Edit</a>
                                    <form action="{{ url('/documents/'.$document->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit">Delete</button>
                                    </form>
                                @else
                                    <form action="{{ route('documents.password', ['document' => $document]) }}" method="post">
                                        @csrf
                                        @method('GET')
                                        Password: <input type="password" name="password" id="" class="form-control" value=""><br>
                                        @error('password') <span class="text-danger">{{ $message }}</span><br>@enderror
                                        <button type="submit" class="btn btn-success btn-lg">Confirmar password</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $documents->links('pagination::bootstrap-4') }}
    </div>
@endsection
