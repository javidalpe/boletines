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
                {!! Form::open(['url' => route('invites.store'), 'method' => 'post']) !!}
                @component('components.form-group', ['name' => 'emails'])
                    {!! Form::text('emails', null, array('class' => 'form-control', 'id' => 'emails', 'placeholder' => 'Introduce los correos electrónicos')) !!}
                @endcomponent
                <div class="form-group">
                    {!! Form::submit('Invitar', array('class' => 'btn btn-primary')) !!}
                </div>
                {!! Form::close() !!}
            @endcomponent

            @if(count($invites))
                @component('components.panel')
                    @slot('title')
                        Invitaciones enviadas pendientes
                    @endslot
                    @foreach($invites as $invite)
                        <div>{{ $invite->email }}</div>
                    @endforeach
                @endcomponent
            @endif

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



            @component('components.panel')
                @slot('title')
                    Envianos tus comentarios para conseguir una alerta
                @endslot
                @if(Auth::user()->feature)
                    Ya hemos recibido tus comentarios. Muchas gracias. Te hemos incrementado el número de alertas.
                @else
                    {!! Form::open(['url' => route('account.update', Auth::user()), 'method' => 'put']) !!}
                    @component('components.form-group', ['name' => 'useful', 'label' => '¿Encuentras útil esta servicio?'])
                        {!! Form::text('useful', null, array('class' => 'form-control', 'id' => 'useful', 'placeholder' => '')) !!}
                    @endcomponent
                    @component('components.form-group', ['name' => 'feature', 'label' => '¿Qué funcionalidad te gustaría tener y no tienes ahora?'])
                        {!! Form::text('feature', null, array('class' => 'form-control', 'id' => 'feature', 'placeholder' => '')) !!}
                    @endcomponent
                    @component('components.form-group', ['name' => 'improvement', 'label' => '¿Tienes alguna sugerencia de mejora?'])
                        {!! Form::text('improvement', null, array('class' => 'form-control', 'id' => 'improvement', 'placeholder' => '')) !!}
                    @endcomponent
                    <div class="form-group">
                        {!! Form::submit('Enviar', array('class' => 'btn btn-primary')) !!}
                    </div>
                    {!! Form::close() !!}
                @endif
            @endcomponent
        </div>
    </div>
@endsection

@include('shared.emails')