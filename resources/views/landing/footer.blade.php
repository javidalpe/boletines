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
        <div class="col-md-2"><img class="img-responsive" src="{{mix('img/boe.png')}}" alt=""></div>
        <div class="col-md-4"><img class="img-responsive" src="{{mix('img/lex.png')}}"
                                   alt=""></div>
        <div class="col-md-2 col-md-offset-3"><img class="img-responsive" src="{{mix
        ('img/powered_by_stripe@3x.png')}}"
                                   alt=""></div>
    </div>
</div>
