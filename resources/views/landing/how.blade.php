@extends('layouts.landing')

@section('seo')
    <title>¿Cómo funciona {{ config('app.name') }}?</title>
    <meta name="description" content="Busca en todos los Boletines Oficiales del Estado y Comunidades Autónomas.">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>¿Cómo funciona?</h2>
                <h4>El buscador</h4>
                <p>{{ config('app.name') }} te permite realizar, desde un único sitio, búsquedas
                    diarias en el Boletín Oficial del Estado, en el Diario Oficial de la Unión
                    Europea y en todos los Boletines Oficiales de las Comunidades Autónomas para
                    encontrar si han publicado algo relacionado con tu búsqueda.
                Consulta <a href="{{route('welcome')}}#donde">dónde buscamos</a>.</p>
                <p>Dado el gran volumen de datos que se generan día a día, de momento no
                    buscamos en el histórico completo de las publicaciones, es una
                    búsqueda sobre lo que se pública en los últimos
                    días. En fases posteriores del proyecto, {{ config('app.name') }} permitirá
                    realizar búsquedas
                    sobre el histórico.</p>
                <h4>Nuestra base de datos</h4>
                <p>De forma diaria recorremos las páginas de los diferentes organismos oficiales
                    para descargar y analizar las nuevas
                     publicaciones. Una vez analizadas las publicaciones, el contenido es
                    incorporado a nuestro buscador y automáticamente está disponible para los
                    usuarios.
                    ¿Quieres sabes cuándo fue la última vez que analizamos los boletines? <a
                            href="{{route
                    ('status')}}">Aquí</a>
                    puedes
                    consultar el estado del sistema.</p>
                <h4>Alertas</h4>
                <p>Para facilitarte el trabajo, puedes crear alertas que te avisan todos los días por mail si ese día
                    se ha publicado algo sobre tu búsqueda. <a href="{{route('alerts.create')
                    }}">Crea una alerta aquí</a>.</p>
                <p>Para avisarte cada día, recopilamos en una base de datos los términos de
                    búsqueda de todas las alertas de los usuarios. Durante el proceso de
                    analisis diario de los boletines, si encontramos alguna coincidencia con algún
                    término de búsqueda, enviamos al usuario dueño de esa alerta un email con
                    las coincidencias.
                </p>
                <p>{{ config('app.name') }} no se hace responsable del mal uso por parte de los usuarios, ni del mal funcionamiento del buscador o las alertas.</p>
            </div>
        </div>
    </div>
@endsection
