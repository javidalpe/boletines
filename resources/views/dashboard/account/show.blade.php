@extends('layouts.8-columns')

@section('main')

    @component('components.panel')
        @slot('title')
            Tu cuenta
        @endslot

        <p class="lead">Subscripciones</p>
        <a href="{{route('subscriptions')}}">Portal de facturación</a>
        <p>Descarga tus facturas pasadas, actualiza tus datos fiscales o cambia tu método de pago.</p>
        <a href="{{route('balance.index')}}">Balance en cuenta</a>
        <p>Controla tu balance actual en cuenta.</p>
        <hr>

        <p class="lead">Desarrolladores</p>
        <a href="{{route('webhooks.index')}}">Webhooks</a>
        <p>Los webhooks te permiten recibir las alertas en tus servidores de forma automática.</p>
        <hr>

        <p class="lead">Cuenta</p>
        <a href="{{route('account.edit', Auth::id())}}">Borrado de cuenta</a>
        <p>Entra en esta sección para darte de baja del servicio de {{config('app.name')}}.</p>
    @endcomponent
@endsection
