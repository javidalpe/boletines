@guest
	<li><a href="{{ route('login') }}">Iniciar sesión</a></li>
	<li><a href="{{ route('register') }}">Crear una cuenta</a></li>
@else
	<li><a href="{{ route('account.index') }}">{{ Auth::user()->name }}</a></li>
	<li><a href="#" onclick="document.getElementById('logout-form').submit()">(Cerrar sesión)</a></li>

	<form id="logout-form" action="{{ route('logout') }}" method="POST">
		{{ csrf_field() }}
	</form>

@endguest