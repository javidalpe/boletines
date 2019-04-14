@php
$user = Auth::user();
$customer = Stripe\Customer::retrieve($user->stripe_id);
if ($customer) {
    $balance = $customer->account_balance * -1/ 100 ;
}

@endphp


@extends('layouts.8-columns')

@section('main')
    @component('components.panel')
        @slot('title')
            Balance en cuenta
        @endslot
        <h4>@include('components.money', ['amount' => $balance ])</h4>
        @if($balance > 0)
            <p>Esta cantidad será descontada de tu próxima factura.</p>
        @else
            <p>Un balance positivo en tu cuenta supone un ahorro en tu próxima factura.</p>
        @endif

        @slot('footer')
            <a href="{{route('mgm')}}">Consigue @include('components.money',
                            ['amount' => config('mgm.rewards.inviter')]) de descuento</a>
        @endslot
    @endcomponent
@endsection
