@if (config('services.google-tag-manager.id'))
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{config('services.google-tag-manager.id')}}"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
@endif