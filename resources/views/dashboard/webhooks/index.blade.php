@extends('layouts.8-columns')

@section('main')
    @component('components.panel')
    @slot('title')
        Webhooks
    @endslot
    <p>Cuando una alerta encuentre un nuevo resultado, {{config('app.name')}} lo notificará en estas urls.</p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>URL</th>
            <th>Estado</th>
            <th>Última notificación</th>
            <th>Código de respuesta</th>
        </tr>
        </thead>
        <tbody>
            @foreach($webhooks as $webhook)
                <tr>
                    <td><a href="{{route('webhooks.show', $webhook)}}">{{$webhook->url}}</a></td>
                    <td>@include('dashboard.webhooks.partials.status')</td>
                    <td>{{$webhook->last_notification_at}}</td>
                    <td>{{$webhook->last_notification_response_code}}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

        @slot('footer')
            <a href="{{route('webhooks.create')}}" class="btn btn-primary">Registrar Webhook</a>
        @endslot

    @endcomponent
@endsection
