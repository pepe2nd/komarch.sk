<footer class="container mx-auto px-6 py-20 mt-20">
    {{-- <x-footer.footer-newsletter></x-footer.footer-newsletter> --}}
    <x-footer.footer-navigation
        :navigation="[
            'title' => 'Rýchle odkazy',
            'navItems' => [
                ['title' => 'Kontakty na úrad', 'url' => '/urad'],
                ['title' => 'FAQ / Časté otázky', 'url' => '/frekventovane-otazky'],
                ['title' => 'Impressum', 'url' => '/tiraz'],
            ]
        ]"
        :openingTimes="[
            'title' => 'Úradné hodiny',
        ]"
    ></x-footer.footer-navigation>
</footer>
