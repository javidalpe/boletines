@extends('layouts.landing')

@section('seo')
    <title>Busca sobre {{ $term }} en los últimos boletines</title>
    <meta name="description"
          content="Busca y crea alertas sobre {{ strtolower($term) }} en los boletines oficiales.">

@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h1>{{ $term }}</h1>
                <p>{{ $description }} Y si quieres que busquemos por tí, también puedes <a href="{{route('alerts')}}">crear alertas diarias</a>.</p>
            </div>

            @include('shared.search')
        </div>
    </div>
@endsection
