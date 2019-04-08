<td>
	@if($invoice->status == 'draft')
		<span class="label label-info">Borrador</span>
	@elseif($invoice->status == 'paid')
		<span class="label label-primary">Pagada</span>
	@endif
</td>
<td>#{{$invoice->number}}</td>
<td>
	@if (Carbon\Carbon::createFromTimestamp($invoice->date) > Carbon\Carbon::now())
		<i>(Próximamente)</i>
	@endif
	{{(Carbon\Carbon::createFromTimestamp($invoice->date))
                ->toFormattedDateString()}}
</td>
<td>@include('components.money', ['amount' => $invoice->total/100])</td>
<td>
	@if($invoice->invoice_pdf)
		<a href="{{$invoice->invoice_pdf}}">Descargar factura</a>
	@endif
</td>
