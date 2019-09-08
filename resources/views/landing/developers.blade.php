@extends('layouts.landing')

@section('seo')
    <title>Intégrate con {{ config('app.name') }}</title>
    <meta name="description" content="Usa nuestra herramienta de desarrollo para conectar con los boletines.">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Intégrate con {{ config('app.name') }}</h1>
                <p>Sabemos lo importante que es mejorar el acceso a los Boletines Oficiales del Estado, y eso implica
                    mejorar también el acceso a través de la tecnología. Por ese motivo abrimos nuestra plataforma a
                    los desarrolladores.</p>
                <p>Si buscar incorporar búsquedas a tu aplicación, utiliza nuestra <i>API</i> de consultas. Si lo que
                quieres es recibir notificaciones cada vez que un término aparezca en los boletines, registra
                <i>Webhooks</i>.</p>

                <h2>API</h2>
                <p>Disponemos de una API que te permite buscar en los últimos Boletines Oficiales del Estado. Basada en
                respuestas JSON y respuestas HTTP standard, la API ofrece busquedas de texto con o sin concordancias de
                texto exactas.</p>
                <p>Si quieres acceder a nuestra API de búsqueda, <a href="{{route('contact')}}">contacta con nosotros.</a></p>

                <h2>Webhooks</h2>
                <p>Usa los webhooks para ser notificado cuando las alertas ofrecen nuevos resultados.</p>
                <p>{{ config('app.name') }} puede enviar eventos que notifican a tu aplicación cada vez que una
                    alerta ofrece un nuevo resultado de búsqueda. Esto es especialmente útil cuando quieres
                    recibir en tus sistemas los nuevos resultado de búsqueda.</p>

                <h4>Cuándo usar webhooks</h4>
                <p>Los webhooks son necesarios cuando necesitas que tus sistemas respondan ante un evento de nuevo
                    contenido encontrado en {{ config('app.name') }}. Algunos ejemplos de uso:</p>
                <ul>
                    <li>Enviar un mensaje de chat a un equipo para que revisen los boletines.</li>
                    <li>Acumular varias alertas en un único informe.</li>
                    <li>Generar estadísticas sobre la aparición de un término en los boletines oficiales.</li>
                </ul>

                <h4>Siguientes pasos</h4>

                <a href="{{route('webhooks.index')}}" class="btn btn-default">Configurar webhooks</a>

                <h4>¿Preguntas?</h4>
                <p>Estamos encantados de ayudarte con el código o alguna otra pregunta que te sugiera nuestra
                    plataforma. Accede a la sección <a href="{{route('contact')}}">Contáctanos</a> para comunicarte
                    con nosotros.</p>
            </div>
        </div>
    </div>
@endsection
