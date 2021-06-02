@php
    $edit_url = url($crud->route.'/'.$entry->getKey().'/edit');
@endphp
<div class="media" style="white-space: normal">
    @if($entry->hasMedia('cover'))
    <a href="{{ $edit_url }}">
        {{ $entry->cover_image->img()->attributes(['class' => 'mr-3 img-fluid', 'style' => 'max-width: 120px; height: auto;']) }}
    </a>
    @endif
    <div class="media-bod small">
        <h5 class="mt-0"><a href="{{ $edit_url }}">{{ $entry->title }}</a></h5>
        {{ Str::limit(strip_tags($entry->perex), 120) }}
    </div>
</div>
