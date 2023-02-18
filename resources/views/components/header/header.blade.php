<header class="container mx-auto px-6 pt-2 md:py-12 flex items-end justify-between w-full">
    <a href="{{ route('home') }}" class="flex-none">
        <img src="{{ asset('images/logo/logo_SKA_' . rand(0, 4) . '.svg') }}" alt="{{ __('app.title') }}" class="w-64">
    </a>
    <div id="nav-content" class="nav-menu md:flex">
        <x-header.header-navigation-search class="mr-10" />

        <ul class="flex space-x-2">
            @foreach (\App\Models\Page::topMenu()->limit(4)->get() as $item)
                <li>
                    <x-link-arrow-hover class="whitespace-nowrap" :url="$item->url">
                        {{ $item->title }}
                    </x-link-arrow-hover>
                </li>
            @endforeach
            <li>
                <button type="button" class="w-8 h-7 relative focus:outline-none bg-white bottom-1 hover:text-blue">
                    <span aria-hidden="true"
                        class="block absolute h-px mb-0.5 w-full bg-current transform -translate-y-1.5"></span>
                    <span aria-hidden="true" class="block absolute  h-px mb-0.5 w-full bg-current   transform"></span>
                    <span aria-hidden="true"
                        class="block absolute  h-px w-full bg-current transform  translate-y-1.5"></span>
                </button>
            </li>
        </ul>

    </div>

    <transition name="slide">
        <div class="fixed top-0 right-0 w-full md:w-1/2 h-full bg-black z-40 pt-16">
            <!-- Close button -->
            <button @click="isOpen = false"
                class="absolute right-0 mr-5 z-50 p-3 text-white hover:text-blue focus:outline-none">
                {{ trans('app.close') }}
            </button>

            <div class="flex flex-col py-3 px-8">
                <!-- Navigation items -->
                <ul>
                    @foreach (\App\Models\Page::topMenu()->get() as $i => $item)
                        <li class="{{ $i < 4 ? 'md:hidden' : '' }}">
                            <x-link-arrow-hover class="whitespace-nowrap text-white" :url="$item->url">
                                {{ $item->title }}
                            </x-link-arrow-hover>
                        </li>
                    @endforeach
                </ul>

                <!-- Language switch -->
                <ul class="mt-6">
                    @foreach (LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                        <li class="capitalize">
                            <a rel="alternate" hreflang="{{ $localeCode }}" title="{{ $properties['native'] }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                class="block leading-relaxed text-white hover:text-blue {{ $localeCode == LaravelLocalization::getCurrentLocale() ? 'text-blue' : '' }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </transition>
</header>
