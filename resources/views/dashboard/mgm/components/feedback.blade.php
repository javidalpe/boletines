<div id="mejorar">
    @component('components.panel')
        @slot('title')
            Ayudanos a mejorar. Envianos tus comentarios y conseguirás una alerta extra.
        @endslot
        @if(Auth::user()->feature)
            Ya hemos tokenrecibido tus comentarios. Muchas gracias. Te hemos incrementado el número de alertas.
        @else
            {!! Form::open(['url' => route('account.update', Auth::user()), 'method' => 'put']) !!}
            @component('components.form-group', ['name' => 'useful', 'label' => '¿Encuentras útil este servicio?'])
                {!! Form::text('useful', null, array('class' => 'form-control', 'id' => 'useful', 'placeholder' => '')) !!}
            @endcomponent
            @component('components.form-group', ['name' => 'feature', 'label' => '¿Qué funcionalidad te gustaría tener y no tienes ahora?'])
                {!! Form::text('feature', null, array('class' => 'form-control', 'id' => 'feature', 'placeholder' => '')) !!}
            @endcomponent
            @component('components.form-group', ['name' => 'improvement', 'label' => '¿Tienes alguna sugerencia de mejora?'])
                {!! Form::text('improvement', null, array('class' => 'form-control', 'id' => 'improvement', 'placeholder' => '')) !!}
            @endcomponent
            <div class="form-group">
                {!! Form::submit('Enviar', array('class' => 'btn btn-primary')) !!}
            </div>
            {!! Form::close() !!}
        @endif
    @endcomponent
</div>
