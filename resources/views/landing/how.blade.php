@extends('layouts.landing')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>¿Cómo funciona?</h2>
                <p>{{ config('app.name') }} te permite realizar, desde un único sitio,  búsquedas diarias en todos los Boletines
                    Oficiales del Estado y Comunidades Autónomas para encontrar si han publicado algo relacionado con tu búsqueda.</p>
                <p>De momento no buscamos en el histórico de Boletines, es una búsqueda en lo que se pública en los últimos
                    días.</p>
                <p>Para facilitarte el trabajo, puedes crear alertas que te avisan todos los días por mail, si ese día
                    se ha publicado algo sobre tu búsqueda.</p>
            </div>
        </div>
    </div>
@endsection
