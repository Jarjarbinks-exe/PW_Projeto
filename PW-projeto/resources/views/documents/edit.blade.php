@extends('layouts.autenticado')

@section('main-content')
    <div class="container mt-5">

        @if($document->file_path)
            <div class="row mb-4">
                <div class="col-md-6">
                    <p class="lead">Download File:</p>
                    <form action="{{ route('documents.download', ['document' => $document]) }}" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-primary">Download</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <p class="lead">Send URL to Email:</p>
                    <form action="{{ route('documents.sendEmail', ['document' => $document]) }}" method="post">
                        @method('GET')
                        @csrf
                        <button type="submit" class="btn btn-success">Send Mail</button>
                    </form>
                </div>
            </div>
        @endif

        <div class="mb-4">
            <h4>Current Metadata:</h4>
            <ul class="list-group">
                @foreach($document->metadata as $metadata)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $metadata->value }}
                        <form action="{{ route('documents.removeMetadata', ['document' => $document, 'metadata' => $metadata]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mb-4">
            <h4>Add Metadata:</h4>
            <ul class="list-group">
                @foreach(\App\Services\DocumentService::getUnownedMetadata($document) as $metadata)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $metadata->value }}
                        <form action="{{ route('documents.createMetadata', ['document' => $document, 'metadata' => $metadata]) }}" method="post">
                            @method('GET')
                            @csrf
                            <button type="submit" class="btn btn-success">Add</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
            <div class="mb-4">
                <h4>Add Metadata:</h4>
                <ul class="list-group">
                    @foreach(\App\Services\DocumentService::getUnownedMetadata($document) as $metadata)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $metadata->value }}
                            <form action="{{ route('documents.createMetadata', ['document' => $document, 'metadata' => $metadata]) }}" method="post">
                                @method('GET')
                                @csrf
                                <button type="submit" class="btn btn-success">Add</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-4">
                <h4>Current Categories:</h4>
                <ul class="list-group">
                    @foreach($document->categories as $category)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $category->value }}
                            <form action="{{ route('documents.removeCategory', ['document' => $document, 'category' => $category]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-4">
                <h4>Add Categories:</h4>
                <ul class="list-group">
                    @foreach(\App\Services\DocumentService::getUnownedCategories($document) as $category)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $category->value }}
                            <form action="{{ route('documents.createCategory', ['document' => $document, 'category' => $category]) }}" method="post">
                                @method('GET')
                                @csrf
                                <button type="submit" class="btn btn-success">Add</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-4">
                <h4>Current Permissions:</h4>
                <ul class="list-group">
                    @foreach($document->permissions as $permission)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $permission->value }}
                            <form action="{{ route('documents.removePermission', ['document' => $document, 'permission' => $permission]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-4">
                <h4>Add Permissions:</h4>
                <ul class="list-group">
                    @foreach(\App\Services\PermissionService::getUnownedDocumentPermissions($document) as $permission)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $permission->value }}
                            <form action="{{ route('documents.createPermission', ['document' => $document, 'permission' => $permission]) }}" method="post">
                                @method('GET')
                                @csrf
                                <button type="submit" class="btn btn-success">Add</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-3">
                <a href="{{ url('/documents') }}" class="btn btn-secondary">Back</a>
            </div>
    </div>
@endsection
