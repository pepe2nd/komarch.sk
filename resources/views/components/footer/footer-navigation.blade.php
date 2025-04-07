<nav class="flex flex-col-reverse text-lg xl:flex-row xl:text-base">
    <x-footer.footer-navigation-column :title="$navigation['title']">
        <ul>
            @foreach ($navigation['navItems'] as $item)
                <li>
                    <x-link-arrow-hover :url="$item['url']">
                        {{ $item['title'] }}
                    </x-link-arrow-hover>
                </li>
            @endforeach
        </ul>
    </x-footer.footer-navigation-column>
    <x-footer.footer-navigation-column :title="$openingTimes['title']">
        <x-footer.opening-hours />
    </x-footer.footer-navigation-column>
    <x-footer.footer-navigation-column title="Kontakt">
        Námestie SNP 18, 811 06 Bratislava
        <x-link-arrow url="mailto:komarch@komarch.sk" external>
            komarch@komarch.sk
        </x-link-arrow>
        <x-link-arrow-hover url="tel:+421254431254" class="mt-6 md:mt-4" external>
            + 421 254 431 254
        </x-link-arrow-hover>
        <x-link-arrow-hover url="tel:+421254431080" external>
            + 421 254 431 080
        </x-link-arrow-hover>
        <x-link-arrow
            url="https://www.facebook.com/slovenskakomoraarchitektov" class="block mt-6 md:mt-4" external>
            Facebook
        </x-link-arrow>
        <x-link-arrow url="https://www.instagram.com/slovenskakomoraarchitektov" external>
            Instagram
        </x-link-arrow>
        <x-link-arrow url="https://issuu.com/institutska" external>
            ISSUU
        </x-link-arrow>
    </x-footer.footer-navigation-column>
</nav>
