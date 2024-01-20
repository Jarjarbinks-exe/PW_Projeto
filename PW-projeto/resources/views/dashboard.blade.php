@extends('layouts.autenticado')

@section('main-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if(\App\Services\UserService::getIsAdmin(\Illuminate\Support\Facades\Auth::user()))
                        <div class="card-header">Dashboard</div>

                        <div class="card-body">

                            <h2>Número total de utilizadores: {{$data["totalUsers"]}}</h2>

                            <h2> Número total de documentos: {{$data["totalDocuments"]}}</h2>

                            <h1>{{ $data["chartAdmin1"]->options['chart_title'] }}</h1>
                            {!! $data["chartAdmin1"]->renderHtml() !!}


                            <h1>{{ $data["chartAdmin2"]->options['chart_title'] }}</h1>
                            {!! $data["chartAdmin2"]->renderHtml() !!}

                            <h1>{{ $data["chartAdmin3"]->container() }}</h1>

                            <h1> {{$data["chartAdmin4"]->container()}}</h1>
                            <h3> Documentos por Categorias </h3>


                        </div>
                    @else
                        <h2> Número total de documentos: {{$data["totalUserDoc"]}}</h2>
                        <hr>
                        <h3> Categorias dos documentos do {{\Illuminate\Support\Facades\Auth::user()->username}}:</h3>
                        <h3> {{$data["categoriesOfUser"]->container()}}</h3>

                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    @if(\App\Services\UserService::getIsAdmin(\Illuminate\Support\Facades\Auth::user()))
        {!! $data["chartAdmin1"]->renderChartJsLibrary() !!}
        {!! $data["chartAdmin1"]->renderJs() !!}
        {!! $data["chartAdmin2"]->renderJs() !!}
        {!! $data["chartAdmin3"]->script() !!}
        {!! $data["chartAdmin4"]->script() !!}
    @else
        {!! $data["categoriesOfUser"]->script() !!}
    @endif
@endsection
