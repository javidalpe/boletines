@component('components.form-group', ['name' => 'url', 'label' => 'Url:',
'help' => 'Por cada alerta registrada que ofrezca un nuevo resultado enviaremos un evento a esta URL.'])
    {!! Form::url('url', isset($webhook)?$webhook->url:'' , array('class' => 'form-control', 'autofocus' => true)) !!}
@endcomponent
