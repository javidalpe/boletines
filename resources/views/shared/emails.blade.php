@push('styles')
    <link rel="stylesheet" href="/css/multiple-emails.css">
@endpush

@push('scripts')
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="/js/multiple-emails.js"></script>

    <script>
        $('#emails').multiple_emails();
    </script>
@endpush