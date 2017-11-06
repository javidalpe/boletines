@extends('layouts.landing')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>¿Cómo funciona?</h2>
                <p>{{ config('app.name') }} te permite realizar, desde un único sitio,  búsquedas diarias en todos los Boletines
                    Oficiales del Estado y Comunidades Autónomas para encontrar si han publicado algo relacionado con tu búsqueda.
                Consulta <a href="{{route('welcome')}}#donde">dónde buscamos</a>.</p>
                <p>De momento no buscamos en el histórico completo de los Boletines, es una búsqueda en lo que se pública en los últimos
                    días. <a href="{{route('status')}}">Aquí</a> puedes consultar el estado del sistema.</p>
                <p>Para facilitarte el trabajo, puedes crear alertas que te avisan todos los días por mail, si ese día
                    se ha publicado algo sobre tu búsqueda. <a href="{{route('alerts.create')}}">Crea una alerta</a>.</p>
                <p>Infoboe no se hace responsable del mal uso por parte de los usuarios, ni del mal funcionamiento del buscador o las alertas.</p>
            </div>
        </div>
    </div>
@endsection
