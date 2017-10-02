@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			@component('components.panel')
				@foreach($chunks as $chunk)
					<div class="panel panel-default">
						<small>{{ $chunk->content }}</small>
					</div>
				@endforeach
			@endcomponent
		</div>
	</div>
@endsection