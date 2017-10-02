@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        @component('components.panel')
            {!! Form::open(array('route' => 'alerts.store', 'class' => 'form')) !!}
                @include('dashboard.alerts.fields')
            {!! Form::close() !!}
        @endcomponent
    </div>
</div>
@endsection