<div class="my-6 md:my-0">
    @if (isSet($title))
        <div class="text-2xl mb-2 hidden md:block">
            {{ $title }}
        </div>
    @endif
    <link-arrow-back url="{{$backUrl}}" class="text-lg md:text-base">
        {{ $backTitle }}
    </link-arrow-back>
</div>