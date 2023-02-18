<header class="container mx-auto px-6 pt-2 md:py-12 flex items-end justify-between w-full">
    <a href="{{ route('home') }}" class="flex-none">
        <img src="{{ asset('images/logo/logo_SKA_' . rand(0, 4) . '.svg') }}" alt="{{ __('app.title') }}" class="w-64">
    </a>
    <div id="nav-content" class="nav-menu md:flex">
        <x-header.header-navigation-search class="mr-10" />

        <ul class="flex space-x-3">
            @foreach (\App\Models\Page::topMenu()->limit(4)->get() as $item)
                <li>
                    <x-link-arrow-hover class="whitespace-nowrap" :url="$item->url">
                        {{ $item->title }}
                    </x-link-arrow-hover>
                </li>
            @endforeach
        </ul>

    </div>
</header>
