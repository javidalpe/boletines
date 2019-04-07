<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">

			<!-- Collapsed Hamburger -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ url('/') }}">
				{{ config('app.name', 'Laravel') }}
			</a>
		</div>

		<div class="collapse navbar-collapse" id="app-navbar-collapse">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav">
				@include('layouts.menu')
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Authentication Links -->
				@include('layouts.session')
			</ul>
		</div>
	</div>
</nav>

@push('scripts')
<script>
	// Navbar and dropdowns
	var toggle = document.getElementsByClassName('navbar-toggle')[0],
		collapse = document.getElementsByClassName('navbar-collapse')[0],
		dropdowns = document.getElementsByClassName('dropdown');

	// Toggle if navbar menu is open or closed
	function toggleMenu() {
		collapse.classList.toggle('collapse');
		collapse.classList.toggle('in');
	}

	// Close dropdowns when screen becomes big enough to switch to open by hover
	function closeMenusOnResize() {
		if (document.body.clientWidth >= 768) {
			collapse.classList.add('collapse');
			collapse.classList.remove('in');
		}
	}

	// Event listeners
	window.addEventListener('resize', closeMenusOnResize, false);
	toggle.addEventListener('click', toggleMenu, false);
</script>

@endpush
