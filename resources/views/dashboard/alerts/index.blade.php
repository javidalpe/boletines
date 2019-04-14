@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (count($alerts) > 0)
                @component('components.panel-np')
                    @slot('title')
                        Mis alertas
                    @endslot
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Término de búsqueda</th>
                                <th>Última notificación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alerts as $alert)
                                <tr>
                                    <td>{{$alert->query}}</td>
                                    <td>{{isset($alert->notified_at)?$alert->notified_at->toDateString():''}}</td>
                                    <td>
                                        {!! Form::open(['id' => $alert->id, 'route' => ['alerts.destroy', $alert], 'method' => 'DELETE']) !!}
                                            <a href="{{ (new App\Services\Alerts\ReportService())->getReportUrlForTodayAlert($alert)  }}">Comprobar ahora</a>
                                            <span> | </span>
                                            <a href="{{route('alerts.edit', $alert)}}">Editar</a>
                                            <span> | </span>
                                            <a href="#" onclick="document.getElementById({{$alert->id}}).submit()">Borrar</a>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @can ('create', App\Alert::class)
                        @slot('footer')
                        <a href="{{route('alerts.create')}}" class="btn btn-primary">Crear alerta</a>
                        @endslot
                    @endif
                @endcomponent



            @else
                @component('components.empty')
                    @slot('title')
                        No tienes alertas
                    @endslot
                    Por cada alerta que crees recibirás un email si el término de búsqueda aparece en un nuevo boletín.

                    @slot('actions')
                            <a href="{{route('alerts.create')}}" class="btn btn-default">Crear alerta</a>
                    @endslot
                @endcomponent
            @endif
        </div>
    </div>
@endsection
