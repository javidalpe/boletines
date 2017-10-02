@guest
	<li><a href="{{ route('demo') }}">Demo</a></li>
	<li><a href="{{ route('pricing') }}">Precios</a></li>
@else
	<li><a href="{{ route('search') }}">Buscar</a></li>
	<li><a href="{{ route('alerts.index') }}">Alertas</a></li>
@endguest