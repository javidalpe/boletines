@extends('layouts.landing')

@section('seo')
	<title>Busca y crea alertas en el {{ $page->publicationName }}</title>
	<meta name="description"
	      content="Busca y supervisa los contenidos del {{ $page->publicationName }}.">
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>{{ $page->publicationName }}</h1>
				<p>En esta página puedes buscar en las últimas publicaciones del {{ $page->publicationName }}. Con nuestra web puedes buscar de forma gratuita en
					los últimos boletines oficiales de España y Europa. Y si quieres que
					busquemos por tí, también puedes <a href="{{route('alerts')}}">crear alertas diarias</a>.</p>
			</div>

			@include('shared.search')
		</div>

		<div class="row row-after-search">
			<div class="col-md-12">
				<h3>¿Qué cosas puedes buscar en el {{ $page->publicationName }}?</h3>
				<hr>
				@include('landing.seo.components.terms')
			</div>
		</div>
	</div>
@endsection
