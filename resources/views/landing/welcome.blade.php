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
						buscar en el Boletín Oficial del Estado, en el Diario Oficial de la Unión Europea, los
						Boletines Oficiales de las Comunidades Autónomas y en todos los boletines provinciales de España
						para encontrar si han publicado algo relacionado con tu búsqueda.
					</p>
				</div>
			@endunless

			@include('shared.search')
		</div>
		<div class="row row-after-search">
			<div class="col-md-6">
				<h3>¿Qué puedes buscar?</h3>
				<hr>
				<p>Puedes buscar oposiciones, ayudas o concursos, pero también términos concretos como el nombre de una persona,
					empresa, CIF, NIF, Matrícula, nombramiento, normativa, sector… que se
					publica en cualquiera de los boletines
					oficiales en el día de hoy.</p>
				<p>Escriba la palabra o la frase que quieras entre comillas para buscar concordancias exactas. Por
					ejemplo, "Mario Gomez
					Sanchez".</p>
			</div>
			<div class="col-md-6">
				<h3>¿Cómo creo una alerta?</h3>
				<hr>
				<p>Puedes convertir una búsqueda en una alerta. Cada mañana, te enviaremos un email si se ha publicado
					un nuevo boletín con el término de búsqueda. Puedes crear una alerta en la sección <a href="{{route('alerts')
                    }}">Alertas</a>.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<h3 id="donde">¿Dónde buscamos?</h3>
				<hr>
				<h3>Boletines de nivel nacional</h3>
				<a href="{{url( array_values($publicationsPages)[0]->slug )}}">{{ array_values($publicationsPages)[0]->term }}</a>
				<br>
				<a href="{{url( array_values($publicationsPages)[1]->slug )}}">{{ array_values($publicationsPages)[1]->term }}</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<h3>Boletines Autonómicos</h3>
			</div>
		</div>

		@foreach(array_chunk(array_slice($publicationsPages, 2, 19), 3) as $group)
			<div class="row">
				@foreach($group as $page)
					<div class="col-md-4">
						<a href="{{url($page->slug)}}">{{$page->term}}</a>
					</div>
				@endforeach
			</div>
		@endforeach

		<div class="row">
			<div class="col-md-4">
				<h3>Boletines Provinciales</h3>
			</div>
		</div>

		@foreach(array_chunk(array_slice($publicationsPages, 21), 3) as $group)
			<div class="row">
				@foreach($group as $page)
					<div class="col-md-4">
						<a href="{{url($page->slug)}}">{{$page->term}}</a>
					</div>
				@endforeach
			</div>
		@endforeach


		<div class="row row-after-search">
			<div class="col-md-12">
				<h3>Los más buscado en los boletines oficiales</h3>
				<hr>
				@foreach(array_chunk($pages, 4) as $group)
					<div class="row">
						@foreach($group as $page)
							<div class="col-md-3 col-sm-6">
								<a href="{{url($page->slug)}}">{{$page->term}}</a>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
