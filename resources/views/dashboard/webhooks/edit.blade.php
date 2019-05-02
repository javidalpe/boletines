@extends('layouts.8-columns')

@section('main')
    @component('components.panel')
        @slot('title')
            Editar Webhook
        @endslot
        {!! Form::open(array('url' => route('webhooks.update', $webhook), 'class' => 'form', 'method' => 'PUT')) !!}
            @include('dashboard.webhooks.partials.fields')
            @include('components.form-submit', ['fallback' => route('webhooks.index')])
        {!! Form::close() !!}
    @endcomponent
@endsection
