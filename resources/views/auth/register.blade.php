@extends('layouts.app')


@section('seo')
    <title>Crea una cuenta en el buscador {{ config('app.name') }}</title>
    <meta name="description" content="Crea una cuenta para gestionar tus propias alertas de búsqueda.">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p>Para poder convertir una búsqueda en alerta diaria necesitamos que te registres para poder gestionar esta
                u otras alertas que crees y que nos des un mail donde mandarte las alertas.

                Como explicamos en <a href="{{route('about')}}">Acerca de nosotros</a> estamos en una fase de
                investigación en este proyecto y solo vamos a usarlos para este fin. Podrás darte de baja y todos tus
                datos serán eliminados.</p>
            <div class="panel panel-default">
                <div class="panel-heading">Crea una cuenta nueva</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre de la persona de contacto</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Dirección de correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Repite la contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Crear una cuenta
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <p><strong>¿Tienes una cuenta de Google?</strong></p>
                                @include('auth.google', ['label' => 'Registrate con Google'])
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
