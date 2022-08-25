<header class="container-narrow mx-auto">
    @if ($contest->cover_image)
        {!! $contest->cover_image->img()->attributes(['alt' => e($contest->title), 'class' => 'mt-14 max-h-64 w-auto']) !!}
    @endif

    <div class="lg:flex mt-14 text-sm">
        <x-contest.contest-header-meta :contest="$contest"></x-contest.contest-header-meta>
        <x-share-bar></x-share-bar>
    </div>
    <h1 class="text-2xl tracking-tight leading-snug mt-4 lg:mt-14">{{ $contest->title }}</h1>
</header>
