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
                                <a href="{{ url('/documents/'.$document->id.'/edit') }}">edit</a>
                                <form action="{{ url('/documents/'.$document->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit">delete</button>
                                </form>
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
