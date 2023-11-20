@extends('layouts.autenticado')

@section('main-content')
    <form method="post" action="{{ route('documents.upload') }}" enctype="multipart/form-data">
        @csrf

        <label for="document">Choose Document:</label>
        <input type="file" name="document" id="document" required>

        <p>Select Metadata Types:</p>

        @foreach (\App\Services\DocumentService::getMetadata() as $metadata)
            <label>
                <input type="checkbox" name="metadata_types[]" value="{{ $metadata->id }}">
                {{ $metadata->value }}
            </label><br>
        @endforeach

        <button type="submit">Upload Document</button>
    </form>
@endsection
