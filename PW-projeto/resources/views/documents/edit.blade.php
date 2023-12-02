@extends('layouts.autenticado')

@section('main-content')

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
@endsection
