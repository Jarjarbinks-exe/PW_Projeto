@extends('layouts.autenticado')

@section('main-content')
    <form method="post" action="{{ route('documents.upload') }}" enctype="multipart/form-data">
        @method('GET')
        @csrf
        <label for="document">Choose Document:</label>
        <input type="file" name="document" id="document" required>
        <br>
        <label for="password_sim">
            <input type="radio" name="password" id="password_sim" value="sim" onclick="showPassword()" checked> Sim
        </label>

        <label for="password_nao">
            <input type="radio" name="password" id="password_nao" value="nao" onclick="hidePassword()"> Não
        </label>

        <label for="password" id="passwordLabel">
            <input type="password" name="password_fill" id="password" >
        </label>

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

<script>
    function showPassword() {
        document.getElementById('password').style.display = 'block';
    }

    function hidePassword() {
        document.getElementById('password').style.display = 'none';
    }
</script>
