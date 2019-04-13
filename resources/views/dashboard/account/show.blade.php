@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @include('balance.index')

            @if(count($invoices) > 0)
                @include('dashboard.invoices.index')
            @endif

            @include('dashboard.webhooks.index')

            @component('components.panel')
                @slot('title')
                    Borrar la cuenta y todos sus datos
                @endslot
                {!! Form::open(array('route' => ['account.destroy', Auth::user()], 'method'=>'DELETE', 'class' => 'form')) !!}
                <div class="form-group">
                    {!! Form::checkbox('name', 'value', false, ['required']); !!} Acepto que esta acción es irreversible
                </div>
                <div class="form-group">
                    {!! Form::submit('Borrar mi cuenta', array('class' => 'btn btn-default')) !!}
                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection
