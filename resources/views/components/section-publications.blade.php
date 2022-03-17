<section class="border-b border-black md:border-b-0 py-10">
    <x-heading-section>
        <x-link-arrow :url="$linkUrl" target="_blank">
            {{ $title }}
        </x-link-arrow>
    </x-heading-section>

    @foreach ($publications as $publication)
        <div class="px-5 sm:px-10">
            <a href="{{ $publication->issuu_url }}" target="_blank">
                <img
                    src="{{ Storage::url($publication->cover_image) }}"
                    alt="{{ $publication->name }}"
                    class="object-cover mt-10 mb-10 mx-auto shadow-2xl sm:max-w-xs"
                />
            </a>
        </div>
    @endforeach

</section>
