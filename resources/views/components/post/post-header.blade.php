<header class="container-narrow mx-auto">
    @if ($post->cover_image)
        {!! $post->cover_image->img()->attributes(['alt' => $post->title, 'class' => 'mt-14 h-64 w-auto']) !!}
    @endif

    <div class="lg:flex mt-14">
        <x-post.post-header-meta :post="$post"></x-post.post-header-meta>
        <x-post.post-header-share :post="$post"></x-post.post-header-share>
    </div>
    <h1 class="text-xl tracking-tight leading-snug mt-4 lg:mt-14">{{ $post->title }}</h1>
</header>
