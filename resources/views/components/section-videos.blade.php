<section {{ $attributes->merge(['class' => 'py-10']) }}>
    <x-heading-section>
        <x-link-arrow :url="$linkUrl" target="_blank" :title="$linkTitle">
            {{ $title }}
        </x-link-arrow>
    </x-heading-section>
    @foreach ($videos as $video)
        <div class="relative aspect-w-16 aspect-h-9 my-10">
            <iframe
                src="{{ $video->embed_url }}"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                class="absolute w-full h-full"
            >
            </iframe>
        </div>
    @endforeach
</section>
