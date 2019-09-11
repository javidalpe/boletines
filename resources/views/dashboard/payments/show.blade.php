@php
$card = Auth::user()->defaultPaymentMethod()->card;
@endphp

<div class="panel panel-default panel-body">
Tarjeta: {{$card->brand}} ••••{{ $card->last4 }} - Fecha de expiración: ({{
$card->exp_month }}/{{
$card->exp_year
 }})
</div>
