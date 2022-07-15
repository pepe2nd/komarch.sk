<div id="nav-submenu" class="md:flex">
    @foreach ($page->breadcrumbs as $i => $breadcrumb)
        <div class="md:mr-16 lg:mr-24 mb-7 md:mb-0 pl-{{$i * 4}} md:pl-0">
            <x-header.page-navigation-list :items="$breadcrumb->children" :activeItem="$page" />
        </div>
    @endforeach
</div>
