@extends('layouts.landing')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Busca en todos los boletines oficiales y crea tus alertas</h1>
                <p>{{ config('app.name') }} es un prototipo que queremos testar para entender las necesidades de los
                    usuarios en las búsquedas de los boletines oficiales y la creación de alertas.
                    En esta fase de prototipado no tenemos ningún animo lucrativo, es totalmente gratuito y no
                    realizaremos ninguna venta de datos o publicidad.
                    Queremos agradecerte que nos hagas llegar tus comentarios, experiencia de uso y sugerencias en la
                    sección interna
                    <a href="{{ route('rewards')  }}#mejorar">Ayudanos a mejorar</a>.
                </p>
            </div>


            <div id="root"></div>

            @include('shared.search')
        </div>
        <div class="row" style="margin-top: 42px">
            <div class="col-md-4">
                <h3 id="donde">¿Dónde buscamos?</h3>
                <hr>
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
                <p>Podrás convertir cada búsqueda en una
                    alerta que te avisará en tu mail todas las
                    mañanas de los resultados que encuentre
                    en los boletines para esa búsqueda.</p>
            </div>
        </div>
    </div>
@endsection
