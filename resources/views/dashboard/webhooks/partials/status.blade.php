@if($webhook->status === \App\Webhook::STATUS_ERROR)
    <span class="label label-danger">Error de conexión</span>
@elseif($webhook->status === \App\Webhook::STATUS_WARNING)
    <span class="label label-warning">Revisar</span>
@elseif($webhook->status === \App\Webhook::STATUS_OK)
    <span class="label label-success">Correcto</span>
@else
    <span class="label label-info">Estado desconocido</span>
@endif
