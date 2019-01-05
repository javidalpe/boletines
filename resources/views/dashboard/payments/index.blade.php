<div class="form-group">
    <label for="card-element">
        Forma de pago:
    </label>

    @if(Auth::user()->subscribed('main'))
        @include('dashboard.payments.show')
    @else
        @include('dashboard.payments.create')
    @endif

</div>
