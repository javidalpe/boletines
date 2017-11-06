@push('styles')
    <link rel="stylesheet" href="{{ mix('/css/search.css') }}">
@endpush

@push('scripts')
    <script>
        var config = {!! $config !!};
    </script>
    <script src="{{ mix('/js/search.js') }}" async></script>
@endpush