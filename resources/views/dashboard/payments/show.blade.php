@php
$card = Auth::user()->defaultCard();
@endphp

<p>Tarjeta:</p>
<div class="panel panel-default panel-body">
Número de tarjeta: {{$card->brand}} ••••{{ $card->last4 }} Fecha de expiración: ({{
$card->exp_month }}/{{
$card->exp_year
 }})
</div>