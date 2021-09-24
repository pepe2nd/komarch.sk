<header class="container mx-auto px-6 pt-1 md:py-12 lg:flex lg:items-start">
    <x-header.header-navigation
        :navItems="\App\Models\Page::topMenu()->get()"
    />
    <x-header.header-langswitch />
    <x-header.header-logo />
</header>
