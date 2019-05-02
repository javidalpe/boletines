<hr style="margin-top: 82px">
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <p class="lead">Producto</p>
            <hr>
            <ul class="list-unstyled">
                <li><a href="{{route('welcome')}}">Buscar</a></li>
                @auth
                    <li><a href="{{ route('alerts.index') }}">Alertas</a></li>
                @endauth

                @guest
                    <li><a href="{{ route('alerts') }}">Alertas</a></li>
                @endguest
                <li><a href="{{route('developers')}}">Para desarrolladores</a></li>
                <li><a href="{{route('account.index')}}">Darse de Baja</a></li>

            </ul>
        </div>
        <div class="col-md-3">
            <p class="lead">Ayuda</p>
            <hr>
            <ul class="list-unstyled">
                <li><a href="{{route('how')}}">Acerca de {{ config('app.name') }}</a></li>
                <li><a href="{{route('cookies')}}">Política de Cookies</a></li>
                <li><a href="{{route('privacy')}}">Privacidad</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <p class="lead">Compañía</p>
            <hr>
            <ul class="list-unstyled">
                <li><a href="{{ route('about') }}">Acerca de nosotros</a></li>
                <li><a href="{{ route('contact') }}">Contáctanos</a></li>
                <li><a href="{{route('status')}}">Estado del sistema</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <p>&copy; {{config('app.name')}}<p>
        </div>
    </div>
    <div class="row" style="margin-top: 40px; margin-bottom: 40px">
        <div class="col-md-2">
            <img class="img-responsive" src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                 data-src="{{mix('img/boe.png')}}" alt="Busca en el Boletín Oficial del Estado">
        </div>
        <div class="col-md-4">
            <img class="img-responsive" src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                 data-src="{{mix('img/lex.png')}}" alt="Busca en el Diario Oficial de la Unión Europea">
        </div>
        <div class="col-md-2 col-md-offset-3">
            <img class="img-responsive" src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{{mix('img/powered_by_stripe@3x.png')}}" alt="Con la tecnología de Stripe">
        </div>
    </div>
</div>

@push('scripts')
    <script>
      function init() {
        var imgDefer = document.getElementsByTagName('img');
        for (var i=0; i<imgDefer.length; i++) {
          if(imgDefer[i].getAttribute('data-src')) {
            imgDefer[i].setAttribute('src',imgDefer[i].getAttribute('data-src'));
          } } }
      window.onload = init;
    </script>
@endpush
