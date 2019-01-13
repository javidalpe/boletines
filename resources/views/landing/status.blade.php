@extends('layouts.landing')

@section('seo')
    <title>Estado de la información en {{ config('app.name') }}</title>
    <meta name="description" content="Comprueba el estado y las incidencias de nuestros sistemas.">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h3>Estado de Actualización de la Información</h3>
                <p>Controlamos contínuamente el estado de nuestros sistemas. Si hay alguna interrupción en nuestro
                    servicio podrás verlo aquí.</p>
                <p>¿Tienes problemas? No dudes en <a href="{{ route('contact') }}">contactarnos</a>.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 ">
                @component('components.panel')
                    @slot('title')
                        Publicaciones nacionales
                    @endslot
                    @include('landing.components.publications', ['publications' => $publications1])
                @endcomponent
            </div>
            <div class="col-md-6 ">
                @component('components.panel')
                    @slot('title')
                        Boletines provinciales
                    @endslot
                    @include('landing.components.publications', ['publications' => $publications2])
                @endcomponent

            </div>
        </div>
    </div>
@endsection