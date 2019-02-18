@extends('layouts.landing')

@section('seo')
	<title>Busca y crea alertas en el {{ $publication }}</title>
	<meta name="description"
	      content="Busca y supervisa los contenidos del {{ $publication }}.">
@endsection

@section('content')
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<h1>{{ $page->term }}</h1>
				<p>En esta página puedes buscar en las últimas publicaciones del {{ $publication }} en {{ config('app.name') }}.
					Con nuestra web puedes buscar de forma gratuita en los últimos boletines
					oficiales de España y Europa. Y si quieres que busquemos por tí, también puedes <a href="{{route('alerts')}}">crear alertas diarias</a>.</p>
			</div>

			@include('shared.search')
		</div>
	</div>
@endsection
