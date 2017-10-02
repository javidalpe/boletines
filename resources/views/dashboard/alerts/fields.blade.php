<div class="form-group">
    {!! Form::label('query', 'Termino de búsqueda') !!}
    {!! Form::text('query', null, array('class' => 'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label('emails', 'E-Mail Address') !!}
    {!! Form::text('emails', null, array('class' => 'form-control', 'id' => 'emails')) !!}
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