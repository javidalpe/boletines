@component('components.form-group', ['name' => 'query', 'label' => 'Termino de búsqueda:',
'help' => 'Supervisaremos diariamente 65 boletines oficiales buscando este término. Puedes entrecomillar el término de búsqueda para encontrar concondarcias exactas.'])
    {!! Form::text('query', isset($alert)?$alert->query:session()->pull('query'), array('class' =>
    'form-control', 'autofocus' => true)) !!}
@endcomponent

@component('components.form-group', ['name' => 'email', 'label' => 'Enviar a:',
'help' => 'Escribe el email que recibirá el aviso de nuevos contenidos encontrados.'])
	{!! Form::email('email', isset($alert)?$alert->email:Auth::user()->email, array('class' =>
	'form-control', 'autofocus' => true)) !!}
@endcomponent


@component('components.form-group', ['name' => 'frequency', 'label' => 'Frecuencia:',
'help' => 'Dinos si quieres que busquemos y te avisemos todos los días o sólo una vez a la semana (los lunes).'])
	{!! Form::select('frequency', [
		App\Alert::FREQUENCY_DAILY => 'Como máximo, una vez al día',
		App\Alert::FREQUENCY_WEEKLY => 'Como máximo, una vez a la semana (lunes)',
	], isset($alert)?$alert->frequency:App\Alert::FREQUENCY_DAILY, array('class' =>
	'form-control', 'autofocus' => true)) !!}
@endcomponent
