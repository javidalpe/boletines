@php
    $count = Auth::user()->alerts()->count();
@endphp


<div class="form-group">
    <label for="card-element">
        Precio de la alerta:
    </label>
        @if ($count < 5)
            <h2>15€<small>/mes</small></h2>
        @elseif ($count < 20)
            <h2>12€<small>/mes</small></h2>
        @else
            <h2>8€<small>/mes</small></h2>
        @endif
    <p class="help-block">Precio de la alerta: 15€/mes las 5 primeras alertas. 12€/mes hasta 20 alertas y 8€/mes para más de 20 alertas.
    </p>
</div>