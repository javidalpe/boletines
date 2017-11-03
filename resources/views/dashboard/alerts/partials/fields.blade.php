@component('components.form-group', ['name' => 'query', 'label' => 'Termino de búsqueda', 'help' => 'El término de búsqueda que se usará para buscar en los nuevos boletines.'])
    {!! Form::text('query', null, array('class' => 'form-control')) !!}
@endcomponent

<br>
<div class="form-group">
    {!! Form::submit('Guardar', array('class' => 'btn btn-primary')) !!}
    <a href="{{ route('alerts.index') }}" class="btn btn-default">Cancelar</a>
</div>