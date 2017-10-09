@extends('layouts.landing')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Busca en miles de boletines oficiales</h1>
                <p class="lead">No creeras lo rápido que es nuestro sistema</p>
            </div>
        </div>
        <div class="row">
            <div id="root"></div>
        </div>
    </div>
@endsection

@include('shared.search')