<nav class="md:flex-1 mt-0 mb-10 md:mb-0 md:mt-10 lg:mt-10 md:order-2">
    <navigation-toggle></navigation-toggle>
    <div
        id="nav-content"
        class="nav-menu md:flex text-xl md:text-base"
    >
        @foreach($navItems->split(2) as $i=>$items)
            <div class="flex-1 flex flex-col {{ ($i==0) ? 'lg:ml-40' : 'md:ml-24 lg:ml-16'}}">
                @if ($i==0)
                    <x-header.header-navigation-search class="md:order-last" />
                @endif
                <x-header.header-navigation-list :items="$items" />
            </div>
        @endforeach
    </div>
</nav>
