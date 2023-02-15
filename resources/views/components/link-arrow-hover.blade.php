@php
    $class = 'group block leading-relaxed hover:text-blue pr-5';
    $class .= (url()->current() == $url) ? ' text-blue' : '';
@endphp
<a
    href="{{ $url }}"
    {{ $attributes->merge(['class' => $class]) }}
>
    {{ $slot }}&nbsp;<span class="opacity-0 inline-block transform group-hover:opacity-100 group-hover:translate-x-3 duration-200 {{ $external ?? false ? 'icon-arrow-r' : 'icon-arrow-r-long' }}"></span>
</a>
