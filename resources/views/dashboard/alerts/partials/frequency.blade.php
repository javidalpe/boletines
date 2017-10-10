@if($alert->frequency == App\Alert::FREQUENCY_DAILY)
    Diaria
@else
    Semanal
@endif