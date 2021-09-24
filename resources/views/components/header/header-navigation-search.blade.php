<form action="{{ route('posts.index') }}" autocomplete="off" {{ $attributes->merge(['class' => 'my-5 flex align-center']) }}>
    <input-search placeholder="{{ __('app.search_placeholder') }}"></input-search>
    <span class="icon-search ml-1 text-lg"></span>
</form>
