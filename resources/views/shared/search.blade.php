@push('styles')
    <link rel="stylesheet" href="/css/search.css">
@endpush

@push('scripts')
    <script>
        var config = {!! $config !!};
    </script>
    <script src="/js/search.js" async></script>
@endpush