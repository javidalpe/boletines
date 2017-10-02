@extends('layouts.landing')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Busca en los boletines oficiales</h1>
                <p class="lead">Es la plataforma más potente de búsqueda sobre los boletines oficiales del estado.</p>
                <a href="{{ route('demo') }}" class="btn btn-default">Mira la demo</a> <a href="{{ route('register') }}" class="btn btn-primary">Crea una cuenta</a>
            </div>
        </div>
    </div>
@endsection
