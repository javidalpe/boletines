@component('components.form-group', ['name' => 'query', 'label' => 'Termino de búsqueda', 'help' => 'El término de búsqueda que se usará para buscar en los nuevos boletines.'])
    {!! Form::text('query', null, array('class' => 'form-control')) !!}
@endcomponent

@component('components.form-group', ['name' => 'emails', 'label' => 'Lista de emails', 'help' => 'Estas direcciones de correo quedan suscritar a las alertas de nuevos resultado de búsqueda.'])
    {!! Form::text('emails', null, array('class' => 'form-control', 'id' => 'emails')) !!}
@endcomponent

<div class="form-group">
    {!! Form::submit('Guardar', array('class' => 'btn btn-primary')) !!}
    <a href="{{ route('alerts.index') }}" class="btn btn-default">Cancelar</a>
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