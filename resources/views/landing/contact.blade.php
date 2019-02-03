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
				<p>Si tienes algún problema, alguna sugerencia o alguna pregunta no dudes en
					contactarnos. Estamos encantados de recibir comentarios para mejorar la
					plataforma.</p>
				<p>Si tienes un gran volumen de alertas de búsqueda, contacta con nosotros para ofrecerte una atención
					personalizada.</p>
				<p>Nuestro horario de atención es de 09:00 a 21:00, de lunes a sábado.</p>
				<p>Puedes contactar con nosotros a través de este mail: <a
							href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a></p>
			</div>
		</div>
	</div>
@endsection
