<a
    href="{{ $url }}"
    {{ $attributes->merge(['class' => 'group inline-block leading-relaxed hover:text-blue']) }}
>
    {{ $slot }}
    <span class="inline-block transform group-hover:translate-x-1 group-hover:-translate-y-1 duration-200 icon-arrow-tr"></span>
</a>