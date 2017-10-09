<div class="form-group {{ $errors->has($name) ? ' has-error' : '' }}">
    {!! Form::label($name, $label) !!}
    {{ $slot }}
    <p class="help-block">{{ $help }}</p>
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>