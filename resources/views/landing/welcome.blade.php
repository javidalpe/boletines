@extends('layouts.landing')

@section('seo')
	<title>{{ config('app.name') }}, busca en los boletines oficiales del estado</title>
	<meta name="description"
	      content="{{ config('app.name') }} te permita buscar en todos los boletines oficiales del Estado y crear alertas para estar siempre informado.">
@endsection

@section('content')
	<div class="container">
		<div class="row">

			@unless (Request::get('utm_source') == 'homescreen')
				<div class="col-md-12">
					<h1>Busca en todos los boletines oficiales y crea tus alertas</h1>
					<p>Bienvenido a {{ config('app.name') }}, el único buscador que te permite, desde un único sitio,
						buscar en el Boletín Oficial del Estado, en el Diario Oficial de la Unión Europea, los
						Boletines Oficiales de las Comunidades Autónomas y en todos los boletines provinciales de España
						para encontrar si han publicado algo relacionado con tu búsqueda.
					</p>
				</div>
			@endunless

			@include('shared.search')
		</div>
		<div class="row row-after-search">
			<div class="col-md-6">
				<h3>¿Qué puedes buscar?</h3>
				<hr>
				<p>Puedes buscar el nombre de una persona,
					empresa, CIF, NIF, Matrícula, oposición,
					nombramiento, normativa, sector… que se
					publica en cualquiera de los boletines
					oficiales en el día de hoy.</p>
				<p>Escriba la palabra o la frase que quieras entre comillas para buscar concordancias exactas. Por
					ejemplo, "Mario Gomez
					Sanchez".</p>
			</div>
			<div class="col-md-6">
				<h3>¿Cómo creo una alerta?</h3>
				<hr>
				<p>Puedes convertir una búsqueda en una alerta. Cada mañana, te enviaremos un email si se ha publicado
					un nuevo boletín con el término de búsqueda. Puedes crear una alerta en la sección <a href="{{route('alerts.create')
                    }}">Alertas</a>.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<h3 id="donde">¿Dónde buscamos?</h3>
				<hr>
				<p>Diario Oficial de la Unión Europea (EUR-LEX).</p>
				<p>Boletín Oficial del Estado (BOE).</p>
				<p>Boletines Autonómicos</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<ul>
					<li>Boletín Oficial de la Junta de Andalucía (BOJA)</li>
					<li>Boletín Oficial de Aragón (BOA)</li>
					<li>Boletín Oficial del Principado de Asturias (BOPA)</li>
					<li>Boletín Oficial de Islas Baleares (BOIB)</li>
					<li>Boletín Oficial de Canarias (BOC)</li>
					<li>Boletín Oficial de Cantabria (BOC)</li>
					<li>Diario Oficial de Castilla-La Mancha (DOCM)</li>
				</ul>
			</div>
			<div class="col-md-4">
				<ul>
					<li>Boletín Oficial de Castilla y León (BOCYL)</li>
					<li>Diari Oficial de la Generalitat de Catalunya (DOGC)</li>
					<li>Diario Oficial de Extremadura (DOE)</li>
					<li>Diario Oficial de Galicia (DOG)</li>
					<li>Boletín Oficial de La Rioja (BOR)</li>
					<li>Boletín Oficial de la Comunidad de Madrid (BOCM)</li>
					<li>Boletín Oficial de la Región de Murcia (BORM)</li>
				</ul>
			</div>
			<div class="col-md-4">
				<ul>
					<li>Boletín Oficial de Navarra (BON)</li>
					<li>Boletín Oficial del País Vasco (BOPV)</li>
					<li>Diari Oficial de la Comunitat Valenciana (DOCV)</li>
					<li>Boletín Oficial de la Ciudad Autónoma de Ceuta (BOCCE)</li>
					<li>Boletín Oficial de la Ciudad Autónoma de Melilla (BOME)</li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<p>Boletines Provinciales</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<ul>
					<li>Boletín oficial de A Coruña</li>
					<li>Boletín oficial de Territorio Histórico de Álava</li>
					<li>Boletín oficial de Albacete</li>
					<li>Boletín oficial de Alicante</li>
					<li>Boletín oficial de Almería</li>
					<li>Boletín oficial de Ávila</li>
					<li>Boletín oficial de Badajoz</li>
					<li>Boletín oficial de Barcelona</li>
					<li>Boletín oficial de Burgos</li>
					<li>Boletín oficial de Cáceres</li>
					<li>Boletín oficial de Cádiz</li>
					<li>Boletín oficial de Castellón</li>
					<li>Boletín oficial de Ciudad Real</li>
					<li>Boletín oficial de Córdoba</li>
					<li>Boletín oficial de Cuenca</li>
				</ul>
			</div>
			<div class="col-md-4">
				<ul>
					<li>Boletín oficial de Girona</li>
					<li>Boletín oficial de Granada</li>
					<li>Boletín oficial de Guadalajara</li>
					<li>Boletín oficial de Guipuzkoa</li>
					<li>Boletín oficial de Huelva</li>
					<li>Boletín oficial de Huesca</li>
					<li>Boletín oficial de Jaén</li>
					<li>Boletín oficial de Las Palmas</li>
					<li>Boletín oficial de León</li>
					<li>Boletín oficial de Lleida</li>
					<li>Boletín oficial de Lugo</li>
					<li>Boletín oficial de Málaga</li>
					<li>Boletín oficial de Ourense</li>
					<li>Boletín oficial de Palencia</li>
					<li>Boletín oficial de Pontevedra</li>
				</ul>
			</div>
			<div class="col-md-4">
				<ul>
					<li>Boletín oficial de Salamanca</li>
					<li>Boletín oficial de Santa Cruz de Tenerife</li>
					<li>Boletín oficial de Segovia</li>
					<li>Boletín oficial de Sevilla</li>
					<li>Boletín oficial de Soria</li>
					<li>Boletín oficial de Tarragona</li>
					<li>Boletín oficial de Teruel</li>
					<li>Boletín oficial de Toledo</li>
					<li>Boletín oficial de Valencia</li>
					<li>Boletín oficial de Valladolid</li>
					<li>Boletín oficial de Vizcaya</li>
					<li>Boletín oficial de Zamora</li>
					<li>Boletín oficial de Zaragoza</li>
				</ul>
			</div>
		</div>
		<div class="row row-after-search">
			<div class="col-md-12">
				<h3>¿Qué puedes buscar?</h3>

				@foreach(array_chunk($pages, 4) as $group)
					<div class="row">
						@foreach($group as $page)
							<div class="col-md-3">
								<a href="{{url($page->slug)}}">{{$page->term}}</a>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
