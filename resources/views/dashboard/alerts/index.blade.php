@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if (count($alerts) > 0)
                @else
                    @component('components.empty')
                        @slot('title')
                            No tienes alertas
                        @endslot
                        Las alertas te permiten recibir avisos cuando una búsqueda concreta ofrece un resultado nuevo.

                        @slot('actions')
                                <a href="{{route('alerts.create')}}" class="btn btn-default">Crear alerta</a>
                        @endslot
                    @endcomponent
                @endif
            </div>
        </div>
    </div>
@endsection
