@component('components.form-group', ['name' => 'query', 'help' => 'El término de búsqueda que se usará para buscar en los nuevos boletines.'])
    {!! Form::label('query', 'Termino de búsqueda') !!}
    {!! Form::text('query', null, array('class' => 'form-control')) !!}
@endcomponent

<div class="form-group">
    {!! Form::label('emails', 'E-Mail Address') !!}
    {!! Form::text('emails', null, array('class' => 'form-control', 'id' => 'emails')) !!}
    <p class="help-block">Los emails suscritos a la alerta diaria.</p>
    @if ($errors->has('emails'))
        <span class="help-block">
            <strong>{{ $errors->first('emails') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    {!! Form::submit('Guardar', array('class' => 'btn btn-primary')) !!}
</div>

@push('styles')
    <link rel="stylesheet" href="/css/multiple-emails.css">
@endpush

@push('scripts')
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="/js/multiple-emails.js"></script>

    <script>
        $('#emails').multiple_emails();
    </script>

@endpush