<div class="my-10 md:my-24 text-center md:text-left">
    @isset($title)
        <h1 class="text-2xl tracking-tight leading-snug md:leading-tight">{{ $title }}</h1>
    @endisset
    @isset($text)
        <p class="text-xl md:text-2xl tracking-tight leading-tight mt-8">{{ $text }}</p>
    @endisset
</div>
