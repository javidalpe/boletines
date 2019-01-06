<div class="panel panel-default">
    @if(isset($title))
        <div class="panel-heading">{{$title}}</div>
    @endif

    <div>
        {{$slot}}
    </div>
</div>