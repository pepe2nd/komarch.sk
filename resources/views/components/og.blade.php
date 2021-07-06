@section('og')
    <meta property="og:title" content="{{ $title }}"/>
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ __('app.title') }}" />
    <meta property="og:description" content="{{ $description }}"/>
    <meta property="og:url" content="{{ $url }}"/>
    @if ($attributes->has('cover_image') && !is_null($cover_image))
        <meta property="og:image" content="{{ $cover_image->getFullUrl() }}"/>
    @endif
@stop
