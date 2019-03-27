@php
$user = Auth::user();
$customer = Stripe\Customer::retrieve($user->stripe_id);
if ($customer) {
    $balance = $customer->account_balance * -1/ 100 ;
}

@endphp

@isset($balance)
    @if ($balance > 0)
        @component('components.panel')
            @slot('title')
                Descuento en cuenta
            @endslot
            <h4>@include('components.money', ['amount' => $balance ])</h4>
            <p>Esta cantidad será descontada de tu próxima factura.</p>
        @endcomponent
    @endif
@endisset
