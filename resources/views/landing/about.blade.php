@extends('layouts.landing')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>Sobre nosotros</h2>
                <p>{{ config('app.name') }} es un prototipo que estamos probando para ver si puede ser de utilidad para los usuarios.</p>
                <p>Esta idea surge de dos profesionales que han visto la oportunidad de negocio y queremos explorar con este prototipo si tiene sentido montarlo.</p>
            </div>
        </div>
    </div>
@endsection