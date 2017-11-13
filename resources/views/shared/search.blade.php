<!--[if lte IE 11]>
<div class="col-md-6 col-md-offset-3">
    <div class="alert alert-warning">Atención, el buscador de {{config('app.name')}} no funciona en esta versión de Internet Explorer. Te recomendamos que utilices la última versión de tu navegador o que descargues el navegador Google Chrome o Mozilla Firefox.</div>
</div>
<![endif]-->

<div id="root"></div>

@push('styles')
    <link rel="stylesheet" href="{{ mix('/css/search.css') }}">
@endpush

@push('scripts')
    <script>
        var config = {!! $config !!};
    </script>
    <script src="{{ mix('/js/search.js') }}" async></script>
@endpush