@component('components.panel-np')
    @slot('title')
        Facturas
    @endslot

    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>Número</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Enlace</th>
            </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr>
                <td>#{{$invoice->number}}</td>
                <td>{{(\Carbon\Carbon::createFromTimestamp($invoice->date))
                ->toFormattedDateString()}}</td>
                <td>@include('components.money', ['amount' => $invoice->total/100])</td>
                <td><a href="{{$invoice->invoice_pdf}}">Descargar factura</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endcomponent