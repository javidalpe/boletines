<table class="table table-hover">
    <thead>
    <tr>
        <th>Estado</th>
        <th>Publicación</th>
        <th>Última comprobación</th>
    </tr>
    </thead>
    <tbody>
    @foreach($publications as $publication)
        <tr>
            <td>
                @if (!$publication->last_run_result)
                    <span class="label label-default">Nunca analizado</span>
                @elseif ($publication->last_run_result == \App\Services\ScrapingService::RUN_RESULT_OK)
                    <span class="label label-success">Correcto</span>
                @else
                    <span class="label label-danger">Error</span>
                @endif
            </td>
            <td>
                {{$publication->name}}
            </td>
            <td>
                @if ($publication->last_run_at)
                    {{ $publication->last_run_at->diffForHumans() }}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
