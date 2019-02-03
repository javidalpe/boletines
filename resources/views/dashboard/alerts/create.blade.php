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
                @include('dashboard.alerts.partials.price')
                @include('dashboard.payments.index')
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
    </div>
</div>
@endsection
