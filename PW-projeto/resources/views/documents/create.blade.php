@extends('layouts.autenticado')

@section('main-content')
    <div class="container mt-5">
        <h1>Upload New Document</h1>

        <form method="post" action="{{ route('documents.upload') }}" enctype="multipart/form-data">
            @method('GET')
            @csrf

            <div class="form-group">
                <label for="document">Choose Document:</label>
                <input type="file" name="document" id="document" class="form-control-file" required>
            </div>

            <div class="form-check">
                <input type="radio" name="password" id="password_sim" value="sim" class="form-check-input" onclick="showPassword()" checked>
                <label for="password_sim" class="form-check-label">Sim</label>
            </div>

            <div class="form-check">
                <input type="radio" name="password" id="password_nao" value="nao" class="form-check-input" onclick="hidePassword()">
                <label for="password_nao" class="form-check-label">Não</label>
            </div>

            <div class="form-group" id="passwordLabel" style="display: none;">
                <label for="password">Password:</label>
                <input type="password" name="password_fill" id="password" class="form-control">
            </div>

            <p>Select Metadata Types:</p>

            @foreach (\App\Services\DocumentService::getMetadata() as $metadata)
                <div class="form-check">
                    <input type="checkbox" name="metadata_types[]" value="{{ $metadata->id }}" class="form-check-input">
                    <label class="form-check-label">{{ $metadata->value }}</label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-success mt-3">Upload Document</button>
        </form>

        <div class="mt-3">
            <a href="{{ url('/documents') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection

<script>
    function showPassword() {
        document.getElementById('passwordLabel').style.display = 'block';
    }

    function hidePassword() {
        document.getElementById('passwordLabel').style.display = 'none';
    }
</script>
