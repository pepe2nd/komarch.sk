@php
    $locale = app()->getLocale();
    $items = \App\Models\Page::topMenu()->get()
        ->map(function ($item) use ($locale) {
            return [
                'id' => $item->id,
                'url' => $item->url,
                'title' => $item->getTranslation('title', $locale),
            ];
        });

    $locales = collect();
    foreach (LaravelLocalization::getLocalesOrder() as $localeCode => $properties) {
        $locales[$localeCode] = [
            'native' => $properties['native'],
            'url' => LaravelLocalization::getLocalizedURL($localeCode, null, [], true)
        ];
    }
@endphp

<header class="container mx-auto px-6 pt-2 md:py-12 flex items-end justify-between w-full">
    <a href="{{ route('home') }}" class="flex-none">
        <img src="{{ asset('images/logo/logo_SKA_' . rand(0, 4) . '.svg') }}" alt="{{ __('app.title') }}" class="w-64">
    </a>
    <div id="nav-content" class="nav-menu md:flex">
        <x-header.header-navigation-search class="mr-10" />
        <offcanvas-navigation :items="{{ $items }}" :locales="{{ $locales }}" current-locale="{{ $locale }}"></offcanvas-navigation>
    </div>
</header>
