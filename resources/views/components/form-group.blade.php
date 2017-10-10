<div class="form-group {{ $errors->has($name) ? ' has-error' : '' }}">
    {!! Form::label($name, $label) !!}
    {{ $slot }}
    @if (isset($help))
        <p class="help-block">{{ $help }}</p>
    @endif
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>