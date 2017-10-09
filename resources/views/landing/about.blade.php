@extends('layouts.landing')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>Sobre nosotros</h2>
                <p>{{ config('app.name') }} es un prototipo orientado a descubrir la utilidad de una herramienta de
                    búsqueda sobre los boletines oficiales publicados por el Gobierno de España.</p>
                <p>Esta idea surge de dos profesionales que han descubierto la necesidad de mejorar el acceso a la
                    información publicada por los órganos de gobierno. Descubierta además la oportunidad de negocio,
                    con este piloto quieren explorar la viabilidad del proyecto.</p>
            </div>
        </div>
    </div>
@endsection