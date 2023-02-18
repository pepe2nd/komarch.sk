<form action="{{ route('posts.index') }}" autocomplete="off" {{ $attributes->merge(['class' => 'w-72 flex align-center']) }}>
    <input-search></input-search>
    <span class="icon-search ml-1 text-lg"></span>
</form>
