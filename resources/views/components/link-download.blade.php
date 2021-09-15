<a
    href="{{ $url }}"
    {{ $attributes->merge(['class' => 'group block leading-relaxed hover:text-blue']) }}
>
    {{ $slot }}
    <span class="inline-block transform group-hover:translate-y-1 duration-200 icon-download"></span>
</a>
