@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (count($alerts) > 0)
                @component('components.panel')
                    @slot('title')
                        Alertas
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
                                    <td></td>
                                    <td><a href="{{route('alerts.edit', $alert)}}">Editar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endcomponent
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
