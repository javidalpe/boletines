@php
$card = Auth::user()->defaultCard();
@endphp

<div class="panel panel-default panel-body">
Tarjeta: {{$card->brand}} ••••{{ $card->last4 }} - Fecha de expiración: ({{
$card->exp_month }}/{{
$card->exp_year
 }})
</div>