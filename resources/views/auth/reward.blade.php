@php

$token = Request::query('token');
$reward = config('mgm.rewards.invitee');
if ($token) {
    $who = App\User::where('token', $token)->first();
    if ($who) {
        $name = $who->name;
    }
}
@endphp

@isset($name)
    <div class="well text-center">
        <h2>@include('components.money', ['amount' => $reward]) descuento</h2>
        Crea una cuenta para reclamar tu regalo de {{ $name }}
    </div>
@endisset
