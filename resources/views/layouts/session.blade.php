@guest
	<li><a href="{{ route('login') }}">Login</a></li>
	<li><a href="{{ route('register') }}">Register</a></li>
@else
	<li><a href="#">{{ Auth::user()->name }}</a></li>
	<li><a onclick="document.getElementById('logout-form').submit()">(Cerrar sesión)</a></li>

	<form id="logout-form" action="{{ route('logout') }}" method="POST">
		{{ csrf_field() }}
	</form>

@endguest