@extends('layouts.landing')

@section('seo')
	<title>Sobre {{ config('app.name') }}</title>
	<meta name="description" content="Busca en todos los Boletines Oficiales del España.">
@endsection

@section('content')
	<div style="background-color: #034ea1; color: white; margin-top: -22px; padding: 40px 0">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h2 style="color:white">El más rápido</h2>
					<p>El 90% de las búsquedas se resuelven en menos de 20 milisegundos.</p>
				</div>
				<div class="col-md-4">
					<h2 style="color:white">Eficaz</h2>
					<p>Ofrecemos búsquedas exactas, tolerancia a fallos e ignoramos plurales.</p>
				</div>
				<div class="col-md-4">
					<h2 style="color:white">Global</h2>
					<p>Buscamos en todos los boletines del Estado, 65 publicaciones en total.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12"><h2>Las claves del éxito</h2></div>
			<div class="col-md-6">

				<h4>El buscador</h4>
				<p>{{ config('app.name') }} te permite realizar, desde un único sitio, búsquedas diarias en el Boletín
					Oficial del Estado, en el Diario Oficial de la Unión Europea, en el Boletín Oficial del Registro
					Mercantil, en todos los Boletines Oficiales de las Comunidades Autónomas y en todos los boletines
					publicados por cada provincia (incluyendo ayuntamientos). Consulta <a href="{{route('welcome')}}#donde">dónde buscamos</a>.</p>
				<p>Y no solo es el más amplio del mercado, también es el más rápido. El tiempo medio de respuesta de
					nuestro motor de búsqueda es de 10 milisegundos. Estos tiempos son fundamentales para poder
					ofrecerte nuestra funcionalidad de búsqueda en tiempo real.</p>
				<p>El motor fue construido en 2018 utilizando la última tecnología, y a día de hoy aun
				seguimos optimizándola para ofrecer mejores resultados.</p>
			</div>
			<div class="col-md-6">
				<h4>La base de datos</h4>
				<p>Nuestra tecnología es la más rápida y potente del mercado. Cada día recorremos
					las 65 páginas web de los diferentes organismos oficiales para descargar y analizar las
					nuevas publicaciones. Una vez analizadas las publicaciones, el contenido es incorporado a nuestro
					buscador y automáticamente está disponible para los usuarios.</p>
				<p>Dado el gran volumen de datos que se generan día a día, de momento no
					buscamos en el histórico completo de las publicaciones, es una
					búsqueda sobre lo que se pública en los últimos
					días. En fases posteriores del proyecto, {{ config('app.name') }} permitirá
					realizar búsquedas sobre un historico más antiguo.</p>
				<p>
					¿Quieres sabes cuándo fue la última vez que analizamos los boletines? <a
							href="{{route
                    ('status')}}">Aquí</a>
					puedes consultar el estado del sistema.</p>
			</div>
		</div>
	</div>

@endsection
