<section {{ $attributes->merge(['class' => 'py-10']) }}>
    <x-heading-section>
        <x-link-arrow :url="$linkUrl" target="_blank">
            {{ $title }}
        </x-link-arrow>
    </x-heading-section>

    <div class="md:flex">
    @foreach ($publications as $publication)
        <div class="pr-24">
            <a href="{{ $publication->issuu_url }}" target="_blank">
                <img
                    src="{{ Storage::url($publication->cover_image) }}"
                    alt="{{ $publication->name }}"
                    class="my-10 shadow-2xl sm:max-w-xs w-full h-auto"
                />
            </a>
        </div>
    @endforeach
    </div>
</section>
