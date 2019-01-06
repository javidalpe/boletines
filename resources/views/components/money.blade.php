@php
    setlocale(LC_MONETARY, 'es_ES');
@endphp
{{money_format('%.2n', $amount)}}