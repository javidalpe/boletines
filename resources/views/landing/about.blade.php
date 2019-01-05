@extends('layouts.landing')

@section('seo')
    <title>Sobre {{ config('app.name') }}, cómo surge el buscador</title>
    <meta name="description" content="Conoce el origen y el equipo detrás del proyecto {{ config('app.name') }}.">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>Sobre nosotros</h2>
                <p>Somos un grupo de ingenieros relacionados con las tecnologías de la
                    información y la comunicación. En 2017 descubrimos la necesidad de mejorar
                    el acceso a la información de los
                    boletines oficiales y desde entonces desarrollamos {{ config('app.name') }}.</p>
                <p>¿Quieres saber más sobre nosotros? <a href="{{route('contact')
                }}">Escríbenos</a></p>
            </div>
        </div>
    </div>
@endsection