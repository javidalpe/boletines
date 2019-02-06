@extends('layouts.landing')

@section('seo')
	<title>{{ $page->term }} en los últimos boletines</title>
	<meta name="description"
	      content="Encuentra los últimos contenidos sobre {{ strtolower($page->term) }} en los boletines oficiales.">
@endsection

@section('content')
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<h1>{{ $page->term }}</h1>
				<p>Estos son los resultados de buscar sobre {{ strtolower($page->term) }} en {{ config('app.name') }}.
					Con nuestra web puedes buscar de forma gratuita en los últimos boletines
					oficiales de España. Y si quieres que busquemos por tí, también puedes <a href="{{route('alerts')}}">crear alertas diarias</a>.</p>
			</div>

			@include('shared.search')
		</div>
	</div>
@endsection
