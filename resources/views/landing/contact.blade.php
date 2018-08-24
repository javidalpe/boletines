@extends('layouts.landing')

@section('seo')
	<title>Contacta con {{ config('app.name') }}</title>
	<meta name="description" content="¿Tienes alguna duda o sugerencia sobre {{ config('app.name') }}? Contacta con nosotros.">
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h2>Contacta</h2>
				<p>{{ config('app.name') }} es un prototipo en pruebas. Nuestro objeto es testear su utilidad.</p>
				<p>Si tienes algún problema o alguna sugerencia puedes contactar con nosotros a través de este mail: <a
							href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a></p>
			</div>
		</div>
	</div>
@endsection