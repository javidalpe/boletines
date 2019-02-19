<div class="row">
	<div class="col-md-12">
		<h3>Boletines de nivel nacional</h3>
		<a href="{{url( array_values($publicationsPages)[0]->url )}}">{{ array_values
				($publicationsPages)[0]->publicationName }}</a>
		<br>
		<a href="{{url( array_values($publicationsPages)[1]->url )}}">{{ array_values
				($publicationsPages)[1]->publicationName }}</a>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<h3>Boletines Autonómicos</h3>
	</div>
</div>

@foreach(array_chunk(array_slice($publicationsPages, 2, 19), 3) as $group)
	<div class="row">
		@foreach($group as $page)
			<div class="col-md-4">
				<a href="{{url($page->url)}}">{{$page->publicationName}}</a>
			</div>
		@endforeach
	</div>
@endforeach

<div class="row">
	<div class="col-md-4">
		<h3>Boletines Provinciales</h3>
	</div>
</div>

@foreach(array_chunk(array_slice($publicationsPages, 21), 3) as $group)
	<div class="row">
		@foreach($group as $page)
			<div class="col-md-4">
				<a href="{{url($page->url)}}">{{$page->publicationName}}</a>
			</div>
		@endforeach
	</div>
@endforeach
