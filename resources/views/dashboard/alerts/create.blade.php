@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        @component('components.panel')
            @slot('title')
                Supervisa las publicaciones para encontrar nuevos contenidos interesantes
            @endslot
            {!! Form::open(array('route' => 'alerts.store', 'class' => 'form', 'id' => 'form')) !!}
                @include('dashboard.alerts.partials.fields')
                @include('dashboard.payments.index')
                @include('components.form-submit', ['fallback' => route('alerts.index')])
            {!! Form::close() !!}
        @endcomponent
    </div>
</div>
@endsection