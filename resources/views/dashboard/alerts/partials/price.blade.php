@php
    $count = $alertsCount;
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
    <p class="help-block">@include('dashboard.alerts.partials.description')</p>
    </p>
</div>
