@foreach(array_chunk($termPages, 4) as $group)
	<div class="row">
		@foreach($group as $page)
			<div class="col-md-3 col-sm-6">
				<a href="{{url($page->url)}}">{{$page->termName}}</a>
			</div>
		@endforeach
	</div>
@endforeach
