@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @component('components.panel')
                @slot('title')
                    Edita la alerta
                @endslot
                {!! Form::model($alert, array('route' => ['alerts.update', $alert], 'class' => 'form', 'method' => 'patch')) !!}
                    @include('dashboard.alerts.partials.fields')
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection