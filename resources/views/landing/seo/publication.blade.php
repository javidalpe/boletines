@extends('layouts.landing')

@section('seo')
	<title>{{ $page->term }} en el {{ $publication->name }}</title>
	<meta name="description"
	      content="Busca y crea alertas sobre {{ strtolower($page->term) }} en el {{ $publication->name }}.">
@endsection

@section('content')
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<h1>{{ $page->term }}</h1>
				<p>Estos son los resultados de buscar sobre {{ strtolower($page->term) }} en el {{ $publication->name }} en {{ config('app.name') }}.
					Con nuestra web puedes buscar de forma gratuita en los últimos boletines
					oficiales de España y Europa. Y si quieres que busquemos por tí, también puedes <a href="{{route('alerts')}}">crear alertas diarias</a>.</p>
			</div>

			@include('shared.search')
		</div>
	</div>
@endsection
