@guest
	<li><a href="{{ route('login') }}">Login</a></li>
@else
	<li><a href="{{ route('search') }}">Buscar</a></li>
	<li><a href="{{ route('search') }}">Alertas</a></li>
@endguest