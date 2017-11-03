@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @component('components.panel')
                @slot('title')
                    Invita a otros usuarios para conseguir alertas
                @endslot
                <p>Por cada nuevo usuario que se registre usando este enlace conseguiras una nueva alerta.</p>
                {!! Form::text('link', $url, array('class' => 'form-control')) !!}
                <br>
                <p>O escribe aquí el mail de la persona a la que quieres invitar.</p>
                {!! Form::open(['url' => route('rewardsStore'), 'method' => 'post']) !!}
                @component('components.form-group', ['name' => 'emails'])
                    {!! Form::text('emails', null, array('class' => 'form-control', 'id' => 'emails', 'placeholder' => 'Introduce los correos electrónicos')) !!}
                @endcomponent
                <div class="form-group">
                    {!! Form::submit('Invitar', array('class' => 'btn btn-primary')) !!}
                </div>
                {!! Form::close() !!}
            @endcomponent

            @component('components.panel')
                @slot('title')
                    Usuarios que se han registrado con tu enlace
                @endslot
                @forelse($invitees as $invitee)
                    <div>{{ $invitee->email }}</div>
                @empty
                    <p>Nadie se ha registrado aun con tu enlace.</p>
                @endforelse
            @endcomponent
        </div>
    </div>
@endsection

@include('shared.emails')