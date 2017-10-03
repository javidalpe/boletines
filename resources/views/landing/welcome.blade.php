@extends('layouts.landing')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Busca en los boletines oficiales</h1>
                <p class="lead">Es la plataforma más potente de búsqueda sobre los boletines oficiales del estado.</p>
                <a href="{{ route('demo') }}" class="btn btn-default">Mira la demo</a> <a href="{{ route('register') }}" class="btn btn-primary">Crea una cuenta</a>
            </div>

            <hr>

            <div class="col-md-12">
                <h2>Una base de datos en constante crecimiento</h2>
                <p>Comprobamos diariamente las principales publicaciones del Estado Español. Estas son algunas de las
                publicaciones que gestionamos actualmente.</p>
            </div>
            <div class="col-md-12">
                <h4>Boletines del Estado</h4>
                <ul>
                    <li>Diario oficial Boletín Oficial del Estado (BOE)</li>
                </ul>
            </div>
            <div class="col-md-12">
                <h4>Boletines autonómicos</h4>
            </div>
            <div class="col-md-6">
                <ul>
                    <li>Boletín Oficial de la Junta de Andalucía Abre una nueva ventana (BOJA)</li>
                    <li>Boletín Oficial de Aragón Abre una nueva ventana (BOA)</li>
                    <li>Boletín Oficial del Principado de Asturias Abre una nueva ventana (BOPA)</li>
                    <li>Boletín Oficial de Islas Baleares Abre una nueva ventana (BOIB)</li>
                    <li>Boletín Oficial de Canarias Abre una nueva ventana (BOC)</li>
                    <li>Boletín Oficial de Cantabria Abre una nueva ventana (BOC)</li>
                    <li>Diario Oficial de Castilla-La Mancha Abre una nueva ventana (DOCM)</li>
                    <li>Boletín Oficial de Castilla y León Abre una nueva ventana (BOCYL)</li>
                    <li>Diari Oficial de la Generalitat de Catalunya Abre una nueva ventana (DOGC)</li>
                    <li>Diario Oficial de Extremadura Abre una nueva ventana (DOE)</li>
                    <li>Diario Oficial de Galicia Abre una nueva ventana (DOG)</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul>
                    <li>Boletín Oficial de La Rioja Abre una nueva ventana (BOR)</li>
                    <li>Boletín Oficial de la Comunidad de Madrid Abre una nueva ventana (BOCM)</li>
                    <li>Boletín Oficial de la Región de Murcia Abre una nueva ventana (BORM)</li>
                    <li>Boletín Oficial de Navarra Abre una nueva ventana (BON)</li>
                    <li>Boletín Oficial del País Vasco Abre una nueva ventana (BOPV)</li>
                    <li>Diari Oficial de la Comunitat Valenciana Abre una nueva ventana (DOCV)</li>
                    <li>Boletín Oficial de la Ciudad Autónoma de Ceuta Abre una nueva ventana (BOCCE)</li>
                    <li>Boletín Oficial de la Ciudad Autónoma de Melilla Abre una nueva ventana (BOME)</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
