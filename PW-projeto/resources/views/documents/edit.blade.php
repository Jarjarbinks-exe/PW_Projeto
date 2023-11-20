@extends('layouts.autenticado')

@section('main-content')

    <p>Current Metadata:</p>
    <ul>
        @foreach($document->metadata as $metadata)
            <li>
                Current Metadata: {{ $metadata->value }}
                <form action="{{ route('documents.removeMetadata', ['document' => $document, 'metadata' => $metadata]) }}" method="post">
                    @csrf
                    @method('DELETE')
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
                <form action="{{ route('documents.createMetadata', ['document' => $document, 'metadata' => $metadata]) }}" method="post">
                    @csrf
                    @method('GET')
                    <button type="submit">Add</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
