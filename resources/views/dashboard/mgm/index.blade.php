@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @component('components.panel')
                @slot('title')
                    ¿Quieres más Alertas por menos?
                @endslot
                    <p>Cada vez que un nuevo usuario de {{ config('app.name') }} se
                        registre con tu enlace de invitación, obtendrá un descuento de @include('components.money',
                            ['amount' => config('mgm.rewards.invitee')]) en su primera alerta.</p>
                    <p>Cuando hayan registrado su primera alerta, tú recibirás
                        automáticamente un descuento de @include('components.money',
                            ['amount' => config('mgm.rewards.inviter')]) para tus alertas.</p>

                    @component('components.form-group', ['name' => 'query', 'label' => 'Enlace
                    de invitación:'])
                        @include('components.copy',['id'=> 'link', 'label' => 'Copiar enlace'])
                    @endcomponent

                <br>
                <p>O escribe aquí el email de la persona a la que quieres invitar.</p>
                {!! Form::open(['url' => route('invites.store'), 'method' => 'post']) !!}
                @component('components.form-group', ['name' => 'emails'])
                    {!! Form::text('emails', null, array('class' => 'form-control', 'id' => 'emails', 'placeholder' => 'Introduce los correos electrónicos')) !!}
                @endcomponent
                <div class="form-group">
                    {!! Form::submit('Invitar por email', array('class' => 'btn btn-primary')) !!}
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

        </div>
    </div>
@endsection

@include('shared.emails')
