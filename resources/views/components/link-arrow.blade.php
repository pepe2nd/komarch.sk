<a
    href="{{ $url }}"
    {{ $attributes->merge(['class' => 'group block leading-loose']) }}
>
    {{ $slot }}
    <span class="inline-block transform group-hover:translate-x-2 ml-2 duration-200">
        →
    </span>
</a>
