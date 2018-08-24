@extends('layouts.landing')

@section('seo')
    <title>Estado de la información en {{ config('app.name') }}</title>
    <meta name="description" content="Comprueba el estado y las incidencias de nuestros sistemas.">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h3>Estado de Actualización de la Información</h3>
                <p>Controlamos contínuamente el estado de nuestros sistemas. Si hay alguna interrupción en nuestro
                    servicio podrás verlo aquí.</p>
                <p>¿Tienes problemas? No dudes en <a href="{{ route('contact') }}">contactarnos</a>.</p>

                @component('components.panel')
                    @slot('title')
                        Rastreo de publicaciones oficiales
                    @endslot
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Estado</th>
                                <th>Publicación</th>
                                <th>Última comprobación</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($publications as $publication)
                            <tr>
                                <td>
                                    @if (!$publication->last_run_result)
                                        <span class="label label-default">Never run</span>
                                    @elseif ($publication->last_run_result == \App\Services\ScrapingService::RUN_RESULT_OK)
                                        <span class="label label-success"><i class="glyphicon glyphicon-ok"></i></span>
                                    @else
                                        <span class="label label-danger">error</span>
                                    @endif
                                </td>
                                <td>
                                    {{$publication->name}}
                                </td>
                                <td>
                                    @if ($publication->last_run_at)
                                        {{ $publication->last_run_at->diffForHumans() }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endcomponent
            </div>
        </div>
    </div>
@endsection