@extends('layouts.landing')

@section('seo')
    <title>Política de privacidad de {{ config('app.name') }}</title>
    <meta name="description" content="Estas son las políticas de privacidad del buscador {{ config('app.name') }}.">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>Política de Privacidad</h2>
                <p>Cuando usted rellena el formulario ubicado en nuestra web está ofreciendo datos
                personales: dirección de email.</p>

                <p>Usted puede ver y editar sus datos personales en cualquier momento tras realizarse el
                registro. Puede pedirnos que corrijamos, actualicemos o borremos sus datos
                personales.</p>

                <p>Haremos uso de sus datos personales con el objetivo de ofrecerle la información que
                haya solicitado. No vendemos ni cedemos nuestra lista de clientes o posibles clientes a
                terceras partes.</p>

                <p>Utilizamos los datos personales de manera justa, legal y de acuerdo con la normativa
                actual.</p>
            </div>
        </div>
    </div>
@endsection