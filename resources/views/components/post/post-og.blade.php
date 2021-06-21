@section('og')
    <meta property="og:title" content="{{ $post->title }}"/>
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ __('app.title') }}" />
    <meta property="og:description" content="{{ $post->perex }}"/>
    <meta property="og:url" content="{{ $post->url }}"/>
    @if ($post->cover_image)
        <meta property="og:image" content="{{ $post->cover_image->getFullUrl() }}"/>
    @endif
@stop
