@component('components.panel-np')
    @slot('title')
        Facturas
    @endslot

    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>Estado</th>
                <th>Número</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Enlace</th>
            </tr>
        </thead>
        <tbody>
        @isset($nextInvoice)
            <tr>
                @include('dashboard.invoices.partials.invoice', ['invoice' => $nextInvoice])
            </tr>
        @endisset
        @foreach($invoices as $invoice)
            <tr>
                @include('dashboard.invoices.partials.invoice', ['invoice' => $invoice])
            </tr>
        @endforeach
        </tbody>
    </table>
@endcomponent
