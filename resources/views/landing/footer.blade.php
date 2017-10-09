<hr>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <p class="lead">Producto</p>
            <hr>
            <ul class="list-unstyled">
                <li><a href="{{route('welcome')}}">Buscar</a></li>
                <li><a href="{{route('alerts.index')}}">Alertas</a></li>
                <li><a href="{{route('how')}}">¿Cómo funciona?</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <p class="lead">Ayuda</p>
            <hr>
            <ul class="list-unstyled">
                <li><a href="">Términos</a></li>
                <li><a href="">Privacidad</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <p class="lead">Compañía</p>
            <hr>
            <ul class="list-unstyled">
                <li><a href="{{ route('about') }}">Acerca de nosotros</a></li>
                <li><a href="{{ route('contact') }}">Contáctenos</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <p>&copy; {{config('app.name')}}<p>
        </div>
    </div>
</div>