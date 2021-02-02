<li class="pb-5">
    <div class="d-flex align-items-center text-secondary small">
        @include('components.tags', ['tags' => $post->tags])
        <div class="px-2">·</div>
        <div>{{ $post->published_at->format('d. m. Y') }}</div>
    </div>

    <a href="{{ $post->url }}">
        <h4>{{ $post->title }}</h4>
    </a>
    <div>
        {{ Str::words(strip_tags($post->text), 70) }}
    </div>

</li>