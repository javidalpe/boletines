@extends('layouts.landing')

@section('seo')
	<title>{{ $termPage->termName }} en el {{ $publicationPage->publicationName }}</title>
	<meta name="description"
	      content="Busca y supervisa los contenidos del {{ $publicationPage->publicationName }}.">
@endsection

@section('content')
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<h1>{{ $termPage->termName }} en el {{ $publicationPage->publicationName }}</h1>
				<p>En esta página puedes encontrar los últimos contenidos sobre {{ strtolower($termPage->termName) }} publicados en
					el {{ $publicationPage->publicationName }}. Con nuestra web puedes buscar de forma gratuita en
					los últimos boletines oficiales de España y Europa. Y si quieres que
					busquemos por tí, también puedes <a href="{{route('alerts')}}">crear alertas diarias</a>.</p>
			</div>

			@include('shared.search')
		</div>
	</div>
@endsection
