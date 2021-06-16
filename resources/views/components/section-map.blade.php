<section class="mt-20">
    <x-heading-section>
        <x-link-arrow :url="$worksUrl">
            {{ __('buildings.architecture_register' )}}
        </x-link-arrow>
    </x-heading-section>
    <x-link-arrow :url="$mapUrl" class="mt-10">
        {{ __('buildings.full_map' )}}
    </x-link-arrow>
    <works-map />
</section>
