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
                @include('components.form-submit', ['fallback' => route('alerts.index')])
            {!! Form::close() !!}
        @endcomponent
    </div>

    <div class="col-md-3 col-md-offset-1">
        @component('components.panel')
            @slot('title')
                Sugerencias de alertas
            @endslot
            <ul>
                <li>57247758E</li>
                <li>"Construcciones Herrera SA"</li>
                <li>oposiciones libres bombero</li>
                <li>"Maria Espinosa Garcia"</li>
            </ul>
        @endcomponent

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
                <li><a href="{{route('status')}}">Estado del sistema</a></li>
            </ul>
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
