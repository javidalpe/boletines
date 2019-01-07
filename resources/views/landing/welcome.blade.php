@extends('layouts.landing')

@section('seo')
    <title>{{ config('app.name') }}, busca en los boletines oficiales del estado</title>
    <meta name="description" content="{{ config('app.name') }} te permita buscar en todos los boletines oficiales del Estado y crear alertas para estar siempre informado.">
@endsection

@section('content')
    <div class="container">
        <div class="row">

	        @unless (Request::get('utm_source') == 'homescreen')
	            <div class="col-md-12">
	                <h1>Busca en todos los boletines oficiales y crea tus alertas</h1>
	                <p>Bienvenido a {{ config('app.name') }}, el único buscador que te permite, desde un único sitio, buscar en el Boletín Oficial
                        del Estado, en el Diario Oficial de la Unión Europea y en todos los
                        Boletines Oficiales de las Comunidades Autónomas para encontrar si han
                        publicado algo relacionado con tu búsqueda.
                    </p>
	            </div>
	        @endunless

            @include('shared.search')
        </div>
        <div class="row" style="margin-top: 42px">
            <div class="col-md-4">
                <h3 id="donde">¿Dónde buscamos?</h3>
                <hr>
                <p>Diario Oficial de la Unión Europea (EUR-LEX).</p>
                <p>Boletín Oficial del Estado (BOE).</p>
                <p>Boletines Autonómicos</p>
                <ul>
                    <li>Boletín Oficial de la Junta de Andalucía (BOJA)</li>
                    <li>Boletín Oficial de Aragón (BOA)</li>
                    <li>Boletín Oficial del Principado de Asturias (BOPA)</li>
                    <li>Boletín Oficial de Islas Baleares (BOIB)</li>
                </ul>
                <a data-toggle="collapse" data-target="#mas">Mostrar más</a>
                <ul id="mas" class="collapse">
                    <li>Boletín Oficial de Canarias (BOC)</li>
                    <li>Boletín Oficial de Cantabria (BOC)</li>
                    <li>Diario Oficial de Castilla-La Mancha (DOCM)</li>
                    <li>Boletín Oficial de Castilla y León (BOCYL)</li>
                    <li>Diari Oficial de la Generalitat de Catalunya (DOGC)</li>
                    <li>Diario Oficial de Extremadura (DOE)</li>
                    <li>Diario Oficial de Galicia (DOG)</li>
                    <li>Boletín Oficial de La Rioja (BOR)</li>
                    <li>Boletín Oficial de la Comunidad de Madrid (BOCM)</li>
                    <li>Boletín Oficial de la Región de Murcia (BORM)</li>
                    <li>Boletín Oficial de Navarra (BON)</li>
                    <li>Boletín Oficial del País Vasco (BOPV)</li>
                    <li>Diari Oficial de la Comunitat Valenciana (DOCV)</li>
                    <li>Boletín Oficial de la Ciudad Autónoma de Ceuta (BOCCE)</li>
                    <li>Boletín Oficial de la Ciudad Autónoma de Melilla (BOME)</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3>¿Qué puedes buscar?</h3>
                <hr>
                <p>Puedes buscar el nombre de una persona,
                    empresa, CIF, NIF, Matrícula, oposición,
                    nombramiento, normativa, sector… que se
                    publica en cualquiera de los boletines
                    oficiales en el día de hoy.</p>
                <p>Escriba la palabra o la frase que quieras entre comillas para buscar concordancias exactas. Por ejemplo, "Mario Gomez
                    Sanchez".</p>
            </div>
            <div class="col-md-4">
                <h3>¿Cómo creo una alerta?</h3>
                <hr>
                <p>Puedes convertir una búsqueda en una alerta. Cada mañana, te enviaremos un email si se ha publicado
                 un nuevo boletín con el término de búsqueda. Puedes crear una alerta en la sección <a href="{{route('alerts.create')
                    }}">Alertas</a>.</p>
            </div>
        </div>
    </div>
@endsection
