@component('components.form-group', ['name' => 'query', 'label' => 'Termino de búsqueda', 'help' => 'El término de búsqueda que se usará para buscar en los nuevos boletines. Puedes entrecomillar el término de búsqueda para encontrar concondarcias exactas.'])
    {!! Form::text('query', null, array('class' => 'form-control')) !!}
@endcomponent