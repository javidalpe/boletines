@component('components.form-group', ['name' => 'query', 'label' => 'Termino de búsqueda:',
'help' => 'Supervisaremos diariamente los boletines oficiales buscando este término. Puedes entrecomillar el término de búsqueda para encontrar concondarcias exactas.'])
    {!! Form::text('query', Request::has('query')?Request::get('query'):'', array('class' =>
    'form-control', 'autofocus' => true)) !!}
@endcomponent
