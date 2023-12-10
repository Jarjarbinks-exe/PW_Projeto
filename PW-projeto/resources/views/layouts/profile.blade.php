<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0; /* Cinza claro */
            color: #000; /* Texto preto */
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #fff; /* Fundo branco */
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center; /* Texto centralizado */
        }
        main {
            padding: 20px;
        }
        footer {
            background-color: #333; /* Fundo cinza escuro */
            color: #fff; /* Texto branco */
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
<header>

</header>

<main>
    @yield('content')
</main>

<script src="{{ asset('js/app.js') }}"></script>
<script>
    // Seus scripts aqui
</script>
</body>
</html>
