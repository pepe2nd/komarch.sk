<form action="{{ route('posts.index') }}" class="my-5 flex align-center">
    <input
        type="search"
        name="search"
        placeholder="{{ __('app.search_placeholder') }}"
        aria-label="Hľadať..."
        class="border-b border-gray-900 w-full outline-none text-sm"
        value="{{ request()->input('search') }}"
    >
    <span class="icon-search ml-1"></span>
</form>
