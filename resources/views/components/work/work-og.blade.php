@section('og')
    <meta property="og:title" content="{{ $work->name }}"/>
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Slovenská komora architektov" />
    <meta property="og:url" content="{{ Request::url() }}"/>
    <!-- TODO: fill in the missing description and image -->
    <!--    <meta property="og:description" content="{{ $work->name }}"/>-->
    <!--    <meta property="og:image" content="{{ $work->cover_image }}"/>-->
@stop
