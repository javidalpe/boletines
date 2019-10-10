@extends('layouts.landing')

@section('seo')
	<title>{{ $page->termName }} en los últimos boletines</title>
	<meta name="description"
	      content="Busca y crea alertas sobre {{ strtolower($page->termName) }} en los boletines oficiales.">
	@include('landing.components.adsense')
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>{{ $page->termName }}</h1>
				<p>Estos los últimos contenidos sobre {{ strtolower($page->termName) }} publicados en los boletines oficiales de España.
					Con nuestra web puedes buscar de forma gratuita en los últimos boletines
					oficiales de España y Europa. Y si quieres que busquemos por tí, también puedes <a href="{{route('alerts')}}">crear alertas diarias</a>.</p>
			</div>

			@include('shared.search')
		</div>

		<div class="row row-after-search">
			<div class="col-md-12">
				<h3 id="donde">¿En que boletines puedes buscar sobre {{ strtolower($page->termName) }}?</h3>
				<hr>
				@include('landing.seo.components.publications')
			</div>
		</div>
	</div>
@endsection
