@extends('layouts.landing')

@section('seo')
	<title>Las alertas de {{ config('app.name') }}</title>
	<meta name="description" content="Crea alertas diarias para recibir avisos en tu correo.">
@endsection

@section('content')
	<div class="container">
		<div class="row text-center">
			<div class="col-md-8 col-md-offset-2 ">
				<h2>Supervisa los boletines para estar al día</h2>
				<p>Nuestro motor de búsqueda es gratuito y puedes buscar todas las veces que lo necesites.
				Pero si quieres que busquemos por tí automáticamente todos los días y te avisemos cuando encontremos un
					resultado de búsqueda nuevo, {{ config('app.name') }} ofrece un sistema de alertas.</p>
				<p>Al crear una alerta, supervisaremos diariamente las publicaciones de los boletines oficiales para
				avisarte por correo electrónico si encontramos un nuevo contenido.</p>
				<p class="well">Las alertas tienen un coste de 15€/mes las 5 primeras alertas.
					12€/mes hasta
					20 alertas y 8€/mes
					para más de 20 alertas. Si necesitas un volumen mayor de alertas, <a href="{{ route('contact') }}">
						contacta con nosotros</a>.</p>
				<a href="{{ route('register', Request::query()) }}" class="btn btn-primary">Registrarse y crear una alerta</a>
			</div>
		</div>
	</div>
@endsection
