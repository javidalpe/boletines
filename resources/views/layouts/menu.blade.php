<li><a href="{{ route('welcome') }}">Buscar</a></li>
@auth
	<li><a href="{{ route('alerts.index') }}">Alertas</a></li>
@endauth

@guest
	<li><a href="{{ route('alerts') }}">Alertas</a></li>
@endguest

<li><a href="{{ route('how') }}">Acerca de</a></li>
