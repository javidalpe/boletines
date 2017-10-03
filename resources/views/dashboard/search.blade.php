@extends('layouts.app')

@section('content')
	<div class="row">
		<div id="root"></div>
	</div>
@endsection

@push('styles')
	<link rel="stylesheet" href="https://unpkg.com/react-instantsearch-theme-algolia@4.0.0/style.min.css">
@endpush

@push('scripts')
	<script>
		var config = {!! $config !!};
	</script>
	<script src="/js/search.js"></script>
@endpush