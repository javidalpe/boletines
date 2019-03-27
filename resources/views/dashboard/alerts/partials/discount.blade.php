@php
    $user = Auth::user();
    $customer = Stripe\Customer::retrieve($user->stripe_id);
    if ($customer) {
        $balance = $customer->account_balance * -1/ 100 ;
    }

@endphp

@isset($balance)
    @if ($balance > 0)

        <div class="form-group">
            <label for="card-element">
                Descuento en cuenta:
            </label>
            <p class="text-success">Se aplicará un descuento de <strong>@include('components.money', ['amount' =>
            $balance ])</strong> sobre tu próxima factura.</p>
        </div>
    @endif
@endisset
