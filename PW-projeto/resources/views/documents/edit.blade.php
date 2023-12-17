@extends('layouts.autenticado')

@section('main-content')

    @if($document->file_path)
        <a href="{{ asset('storage/' . $document->file_path) }}"> Document URL</a>

        <p> Download File:</p>
        <form
            action="{{ route('documents.download', ['document' => $document]) }}"
            method="post">
            @method('GET')
            @csrf
            <button type="submit">Download</button>
        </form>

        <p> Send URL to Email:</p>
        <form
            action="{{ route('documents.sendEmail', ['document' => $document]) }}"
            method="post">
            @method('GET')
            @csrf
            <button type="submit">Send Mail</button>
        </form>
    @endif



    <p>Current Metadata:</p>
    <ul>
        @foreach($document->metadata as $metadata)
            <li>
                Current Metadata: {{ $metadata->value }}
                <form
                    action="{{ route('documents.removeMetadata', ['document' => $document, 'metadata' => $metadata]) }}"
                    method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <p>Add Metadata:</p>
    <ul>
        @foreach(\App\Services\DocumentService::getUnownedMetadata($document) as $metadata)
            <li>
                Metadata: {{ $metadata->value }}
                <form
                    action="{{ route('documents.createMetadata', ['document' => $document, 'metadata' => $metadata]) }}"
                    method="post">
                    @method('GET')
                    @csrf
                    <button type="submit">Add</button>
                </form>
            </li>
        @endforeach
    </ul>

    <p>Current Category:</p>
    <ul>
        @foreach($document->categories as $category)
            <li>
                Current Category: {{ $category->value }}
                <form
                    action="{{ route('documents.removeCategory', ['document' => $document, 'category' => $category]) }}"
                    method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <p>Add Category:</p>
    <ul>
        @foreach(\App\Services\DocumentService::getUnownedCategories($document) as $category)
            <li>
                Category: {{ $category->value }}
                <form
                    action="{{ route('documents.createCategory', ['document' => $document, 'category' => $category]) }}"
                    method="post">
                    @method('GET')
                    @csrf
                    <button type="submit">Add</button>
                </form>
            </li>
        @endforeach
    </ul>

    <p>Current Permissions:</p>
    <ul>
        @foreach($document->permissions as $permission)
            <li>
                Current Permission: {{ $permission->value }}
                <form action="{{ route('documents.removePermission', ['document' => $document, 'permission' => $permission]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <p>Add Permissions:</p>
    <ul>
        @foreach(\App\Services\PermissionService::getUnownedDocumentPermissions($document) as $permission)
            <li>
                Permission: {{ $permission->value }}
                <form action="{{ route('documents.createPermission', ['document' => $document, 'permission' => $permission]) }}" method="post">
                    @method('GET')
                    @csrf
                    <button type="submit">Add</button>
                </form>
            </li>
        @endforeach
    </ul>


@endsection
