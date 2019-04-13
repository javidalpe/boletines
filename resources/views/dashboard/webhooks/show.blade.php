@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @component('components.panel')
                @slot('title')
                    Webhook
                @endslot
                    <dl>
                        <dt>URL:</dt>
                        <dd>{{$webhook->url}} <a href="{{route('webhooks.edit', $webhook)}}">(Editar)</a><dd>

                        <dt>Status:</dt>
                        <dd>@include('dashboard.webhooks.partials.status')</dd>

                        <dt>Creado el:</dt>
                        <dd>{{$webhook->created_at}}</dd>


                        @if ($webhook->last_notification_at)
                            <dt>Última notificiación enviada:</dt>
                            <dd>{{$webhook->last_notification_at}}</dd>

                            <dt>Contenido enviado al servidor:</dt>
                            <dd><code>{{$webhook->last_notification_request_body}}</code></dd>

                            <dt>Código de respuesta del servidor:</dt>
                            <dd>{{$webhook->last_notification_response_code}}</dd>

                            <dt>Cuerpo de la respuesta del servidor:</dt>
                            <dd><code>{{$webhook->last_notification_response_body}}</code></dd>
                        @endif
                    </dl>
                @slot('footer')
                        {!! Form::open(array('url' => route('webhooks.destroy', $webhook), 'class' => 'form', 'method' =>
                        'DELETE')) !!}
                        <a href="{{route('webhooks.test', $webhook)}}" class="btn btn-default">Probar webhook</a>
                        <input type="submit" class="btn btn-default" value="Eliminar"/>
                        {!! Form::close() !!}
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
