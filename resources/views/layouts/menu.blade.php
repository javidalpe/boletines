@guest
	<li><a href="{{ route('demo') }}">Demo</a></li>
	<li><a href="{{ route('pricing') }}">Precios</a></li>
@else
	<li><a href="{{ route('search') }}">Buscar</a></li>
	<li><a href="{{ route('search') }}">Alertas</a></li>
@endguest