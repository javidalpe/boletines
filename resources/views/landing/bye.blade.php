@extends('layouts.landing')

@section('seo')
	<title>{{ config('app.name') }}. 2022, cese de actividad</title>
	<meta name="description" content="Nos despedimos del proyecto. Cese de actividad en Enero de 2022">
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Comunicado sobre el cese de actividad en 2022</h2>
				<p><i>28 de Mayo de 2021</i></p>
				<p>Tras más de 4 años de servicio ininterrumpido, el equipo de Infoboe ha decidio que la plataforma cesará su actividad a partir del día 1 de enero de 2022. Todas las subscripciones serán canceladas el día 1 de diciembre de 2021. Os explicamos por qué:</p>
				<p>Infoboe.com nació en 2017, hace ya más de cuatro años. Eramos un grupo de ingenieros trabajando en el sector de la consultoría tecnológica, con diferentes experiencias pero con las mismas ganas de montar un proyecto juntos. Habíamos desarrollado varios proyectos relacionados con la administración, y el acceso a los datos parecía un tema común que interesaba a varias empresas. Coincidió además con el lanzamiento de una tecnología de motor de búsqueda muy novedosa, que permitía realizar búsquedas sobre grandes volúmenes de texto de forma casi instantanea.</p>
				<p>Cacharreando con la tecnología pronto vimos tracción en el proyecto. Empezamos a recibir visitas en la página web, y las peticiones de los usuarios nos hicieron evolucionar el proyecto hacia algo más formal. Primero vino el buscador público, luego el sistema de alertas por subscripción, las invitaciones, y por último nuestra apuesta por el SEO. Pasamos rápidamente de 18 boletines oficiales a los actuales 65 y las visitas de dispararon.</p>
				<p>Nunca pensamos que este proyecto sería rentable, pero comprendimos que merecía la pena buscar un modelo de negocio para poder mantenerlo. Los costes empezaban a hacer mella en el proyecto, así decidimos experiementar. Por ejemplo, durante varios meses intentamos monetizar las visitas con publicidad. La experiencia de usuario empeoró, así que dicidimos buscar un modelo más acorde con nuestra tecnología y los costes asociados a la misma. Tras varias iteraciones sobre precios, el modelo actual de pago por alerta se impuso como el más cómodo y fiable para nuestros usuarios.</p>
				<p>A día de hoy, 9.432 usuarios se han registrado en la platafirna. Solo en el buscador público, recibimos 4.229 usuarios nuevos al mes y contamos con 10.107 impresiones mensuales. Nuestro SEO no ha parado de mejorar; por ejemplo, la búsqueda en Google de <i>administración de loterías concurso 2021 boe</i> te mostrará Infoboe como primera opción.</p>
				<p>Los usuarios de pago ya cubren el total de los gastos de la plataforma. Sin embargo, seguimos sufriendo problemas técnicos que requieren la intervención personal de uno de nosotros para solventarlos. Y mientras que esto no suponía un inconveniente hace unos años, nuestro equipo ha evolucionado y ya no se encuentra en las mismas condiciones.</p>
				<p>Nuestras situaciones personales han cambiado y nuestras motiaciones ya no se alinean de la forma necesaria para poder mantener y seguir evolucionando el proyecto. Por este motivo, hace unos meses decidimos cesar la actividad en 2022. Hoy hacemos público nuestra decisión.</p>
				<p>La plataforma seguirá operando sin cambios hasta el 31 de diciembre de 2021. Seguiremos manteniendo los servidores, arreglando los problemas que puedan surgir y dando soporte a aquellos usuarios que lo soliciten. El 1 de diciembre de 2021 cancelaremos todas las subscripciones activas y ningún usuario recibirá un nuevo cargo de la plataforma. Finalmente, el 1 de enero de 2022 la página dejará de estár disponible.</p>
				<p>Comprendemos que esta decisión podría afectar a tu negocio o tu búsqueda de empleo. Si necesitas una alternativa, te recomendamos que eches un vistazo al sistema de alertas que ofrece la Agencia Estatal Boletín Oficial del Estado para el BOE y Diario Oficial de la Unión Europea, accesible desde
					<a href="https://www.boe.es/mi_boe/">https://www.boe.es/mi_boe/</a>.</p>
				<p>Finalmente, si crees que dispones de los recursos necesarios para hacerte cargo del proyecto, mantenerlo y evolucionarlo, no dudas en contactar con nosotros. En este tiempo restante nos encantaría encontrar a un nuevo equipo que pueda coger las riendas de este bonito proyecto. Si estás interesado, puedes escribirnos un email a <a
							href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>.</p>
				<p>Ha sido un precioso viaje entre miles y miles de folios.</p>
				<p>El equipode Infoboe.</p>
			</div>
		</div>
	</div>

@endsection
