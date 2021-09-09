<ul>
    @foreach ($items as $item)
        <li>
            <x-link-arrow-hover :url="$item->url" class="{{ ($activeItem->breadcrumbs->contains('id', $item->id)) ? 'text-blue' : '' }}">
                {{ $item->title }}
            </x-link-arrow-hover>
        </li>
    @endforeach
</ul>
