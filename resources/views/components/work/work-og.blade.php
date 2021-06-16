@section('og')
    <meta property="og:title" content="{{ $work->name }}"/>
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ __('app.title') }}" />
    <meta property="og:url" content="{{ $work->url }}"/>
    <meta property="og:description" content="{{ $work->short_description }}"/>
    @if ($work->cover_image)
        <meta property="og:image" content="{{ $work->cover_image->getFullUrl() }}"/>
    @endif
@stop
