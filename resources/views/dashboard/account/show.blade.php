@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @component('components.panel')
                @slot('title')
                    Borrar la cuenta
                @endslot
                {!! Form::open(array('route' => ['account.destroy', Auth::user()], 'method'=>'DELETE', 'class' => 'form')) !!}
                @component('components.form-group', ['name' => 'name', 'label' => 'Acepto que esta acción es irreversible '])
                    {!! Form::checkbox('name', 'value', false, ['required']); !!}
                @endcomponent
                <div class="form-group">
                    {!! Form::submit('Borrar mi cuenta', array('class' => 'btn btn-danger')) !!}
                    <a href="{{ route('alerts.index') }}" class="btn btn-default">Cancelar</a>
                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection