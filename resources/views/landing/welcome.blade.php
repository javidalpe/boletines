@extends('layouts.landing')

@section('seo')
	<title>{{ config('app.name') }}, busca en los boletines oficiales del estado</title>
	<meta name="description"
	      content="{{ config('app.name') }} te permita buscar en todos los boletines oficiales del Estado y crear alertas para estar siempre informado.">
@endsection

@section('content')
	<div class="container">
		<div class="row">

			@unless (Request::get('utm_source') == 'homescreen')
				<div class="col-md-12">
					<h1>Busca en todos los boletines oficiales y crea tus alertas</h1>
					<p>Bienvenido a {{ config('app.name') }}, el único buscador que te permite, desde un único sitio,
						buscar en el Boletín Oficial del Estado, en el Diario Oficial de la Unión Europea, en el Boletín
						Oficial del Registro Mercantil, en los Boletines Oficiales de las Comunidades Autónomas y en
						todos los boletines provinciales y de ayuntamientos de España.
					</p>
				</div>
			@endunless

			@include('shared.search')
		</div>
		<div class="row row-after-search">
			<div class="col-md-6">
				<h2>¿Qué puedes buscar?</h2>
				<hr>
				<p>Puedes buscar oposiciones, ayudas o concursos, pero también términos concretos como el nombre de una persona,
					empresa, CIF, NIF, matrícula, nombramiento, normativa, … que se
					publiquen en cualquiera de los boletines oficiales.</p>
				<p>Escriba la palabra o la frase que quieras entre comillas para buscar concordancias exactas. Por
					ejemplo, "Mario Gomez
					Sanchez".</p>
			</div>
			<div class="col-md-6">
				<h2>¿Cómo creo una alerta?</h2>
				<hr>
				<p>Si quieres que supervisemos a diario las publicaciones por ti y te avisemos por email si se ha publicado
					un nuevo boletín con un término de búsqueda concreto, puedes crear una alerta en la sección <a href="{{route('alerts')
                    }}">Alertas</a>.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3 id="donde">¿Dónde busca {{config('app.name')}}?</h3>
				<hr>
				@include('landing.seo.components.publications')
			</div>
		</div>

		<div class="row row-after-search">
			<div class="col-md-12">
				<h3>Los más buscado en los boletines oficiales</h3>
				<hr>
				@include('landing.seo.components.terms')
			</div>
		</div>
	</div>
@endsection
