@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-1">
        @component('components.panel')
            @slot('title')
                Crear nueva alerta
            @endslot
            {!! Form::open(array('route' => 'alerts.store', 'class' => 'form', 'id' => 'form')) !!}
                @include('dashboard.alerts.partials.fields')

                @if($shouldPay)
                    @include('dashboard.alerts.partials.price')
                    @include('dashboard.payments.index')
                    @include('dashboard.alerts.partials.discount')
                @else
                    @include('dashboard.alerts.partials.free')
                @endif
                @include('components.form-submit', [
	                    'action' => $user->subscribed('main') ? 'Guardar' : 'Probar 1 mes gratis',
	                    'fallback' => route('alerts.index')
                ])
            {!! Form::close() !!}
        @endcomponent
    </div>

    <div class="col-md-4 col-md-offset-1">
        @component('components.panel')
            @slot('title')
                ¿Dónde buscamos?
            @endslot
            <ul>
                <li>Boletín Oficial del Estado</li>
                <li>Diario Oficial de la Unión Europea</li>
                <li>Boletín Oficial del Registro Mercantil</li>
                <li>18 Boletines de comunidades autónomas</li>
                <li>44 Boletines provinciales</li>
            </ul>

            <a href="{{route('status')}}">Estado del sistema</a>
        @endcomponent

            @component('components.panel')
                @slot('title')
                    Estadísticas hasta la fecha
                @endslot
                <ul>
                    <li>{{ number_format(\App\Run::count(), 0, ",", ".") }} boletines analizados</li>
                    <li>{{ number_format(\App\Chunk::count(), 0, ",", ".") }} páginas almacenadas</li>
                </ul>
            @endcomponent
    </div>
</div>
@endsection
