@isset($suggestion)
    <div class="help-block col-md-12">{{ $suggestion }}</div>
@endisset

<div id="alert" class="col-md-6 col-md-offset-3" style="display: none">
    <div class="alert alert-warning">Atención, el buscador de {{config('app.name')}} no funciona en este navegador. Te recomendamos que utilices la última versión de tu navegador o que descargues el navegador Google Chrome o Mozilla Firefox.</div>
</div>

<div id="root"></div>

@push('scripts')
    <script>
        var config = {!! $config !!};
    </script>
    <script async defer src="{{ mix('/js/search.js') }}"></script>
    <script>
        setInterval(function () {
            if (document.getElementById('root').children.length <= 0) {
                document.getElementById('alert').style.display = "block";
            } else {
                document.getElementById('alert').style.display = "none";
            }
        }, 3000);
    </script>
@endpush

@push('deferred-styles')
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/search.css') }}"/>
@endpush
