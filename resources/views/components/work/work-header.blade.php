<header class="container-narrow mx-auto">
    <image-gallery class="mt-16" source-url="works/{{ $work->id }}/images"></image-gallery>
    <x-work.work-header-meta :work="$work"></x-work.work-header-meta>
    <div class="flex items-center space-between mt-4 lg:mt-14">
        <h1 class="text-xl tracking-tight leading-snug">{{ $work->name }}</h1>
        <x-share-bar></x-share-bar>
    </div>
</header>
