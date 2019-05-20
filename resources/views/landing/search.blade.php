@extends('layouts.landing')

@section('seo')
    <title>{{ config('app.name') }}, busca en los boletines oficiales del estado</title>
    <meta name="description"
          content="{{ config('app.name') }} te permita buscar en todos los boletines oficiales del Estado y crear alertas para estar siempre informado.">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @include('shared.search')
        </div>
    </div>
@endsection
