@extends('layouts.8-columns')

@section('main')
    @component('components.panel')
        @slot('title')
            Registrar Webhook
        @endslot
        {!! Form::open(array('route' => 'webhooks.store', 'class' => 'form')) !!}
            @include('dashboard.webhooks.partials.fields')
            @include('components.form-submit', ['fallback' => route('account.index')])
        {!! Form::close() !!}
    @endcomponent
@endsection
