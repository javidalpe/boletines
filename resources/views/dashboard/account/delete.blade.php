@extends('layouts.8-columns')

@section('main')

    @component('components.panel')
        @slot('title')
            Borrar la cuenta y todos sus datos
        @endslot
        {!! Form::open(array('route' => ['account.destroy', Auth::user()], 'method'=>'DELETE', 'class' => 'form')) !!}
        <div class="form-group">
            {!! Form::checkbox('name', 'value', false, ['required']); !!} Acepto que esta acción es irreversible
        </div>
        <div class="form-group">
            {!! Form::submit('Borrar mi cuenta', array('class' => 'btn btn-danger')) !!}
            <a href="{{route('account.index')}}" class="btn btn-default">Cancelar</a>
        </div>
        {!! Form::close() !!}
    @endcomponent

@endsection
