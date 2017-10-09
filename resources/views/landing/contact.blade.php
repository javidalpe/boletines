@extends('layouts.landing')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>Contacta</h2>
                <p>{{ config('app.name') }} es un prototipo que estamos probando para ver si puede ser de utilidad para los usuarios.</p>
                <p>Si quieres contactar con nosotros puedes hacerlo en este mail: <a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a></p>
            </div>
        </div>
    </div>
@endsection