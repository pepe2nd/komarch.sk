<header class="container mx-auto px-6 md:px-6 pt-2 md:py-12 lg:flex lg:items-start">
    <x-header.header-navigation
        :navItems="\App\Models\Page::topMenu()->get()"
    />
    <x-header.header-langswitch />
    <x-header.header-logo />
</header>
