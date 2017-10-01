@guest
	<li><a href="{{ route('login') }}">Login</a></li>
	<li><a href="{{ route('register') }}">Register</a></li>
@else
	<li>
		<form id="logout-form" action="{{ route('logout') }}" method="POST">
			{{ csrf_field() }}
			{{ Auth::user()->name }} <button class="btn btn-link">(Cerrar sesión)</button>
		</form>
	</li>
@endguest