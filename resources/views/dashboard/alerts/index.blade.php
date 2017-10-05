@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (count($alerts) > 0)
                @component('components.panel')
                    @slot('title')
                        Mis alertas
                        <a class="label label-primary pull-right" href="{{route('rewards')}}">{{count($alerts)}}/{{$user->alerts_limit}}</a>
                    @endslot
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Búsqueda</th>
                                <th>Creada el</th>
                                <th>Última notificación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alerts as $alert)
                                <tr>
                                    <td>{{$alert->query}}</td>
                                    <td>{{$alert->created_at->toDateString()}}</td>
                                    <td>{{isset($alert->notified_at)?$alert->notified_at->toDateString():''}}</td>
                                    <td>
                                        {!! Form::open(['id' => $alert->id, 'route' => ['alerts.destroy', $alert], 'method' => 'DELETE']) !!}
                                            <a href="{{route('alerts.edit', $alert)}}">Editar</a>
                                            <a href="#" onclick="document.getElementById({{$alert->id}}).submit()">Borrar</a>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endcomponent

                @can ('create', App\Alert::class)
                    <a href="{{route('alerts.create')}}" class="btn btn-primary">Crear alerta</a>
                @endif
                    <a href="{{route('rewards')}}" class="btn btn-default">Conseguir más alertas</a>

            @else
                @component('components.empty')
                    @slot('title')
                        No tienes alertas
                    @endslot
                    Las alertas te permiten recibir avisos cuando una búsqueda concreta ofrece un resultado nuevo.

                    @slot('actions')
                            <a href="{{route('alerts.create')}}" class="btn btn-default">Crear alerta</a>
                    @endslot
                @endcomponent
            @endif
        </div>
    </div>
@endsection
