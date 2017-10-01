@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h1>Nuestra producto es sencillo, nuestros precios también</h1>
				<p class="lead">Todo claro, sin letra pequeña</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8  col-md-offset-2">
				<div class="list-group">
					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">50€<small>/mes</small></h4>
						<p class="list-group-item-text">Este plan incluye búsquedas ilimitadas.</p>
					</a>
					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading"><small>+</small> 20€ <small>x alerta</small></h4>
						<p class="list-group-item-text">Las alertas te permiten recibir notificaciones por correo.</p>
					</a>
				</div>

			</div>
		</div>
	</div>
@endsection
