@section('og')
    <meta property="og:title" content="{{ $page->title }}"/>
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ __('app.title') }}" />
    <meta property="og:description" content="{{ $page->short_description }}"/>
    <meta property="og:url" content="{{ $page->url }}"/>
    @if ($page->cover_image)
        <meta property="og:image" content="{{ $page->cover_image->getFullUrl() }}"/>
    @endif
@stop
