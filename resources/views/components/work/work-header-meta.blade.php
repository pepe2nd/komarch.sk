<div class="flex mt-4 lg:mt-14">
    @foreach ($work->awards as $award)
        <x-tag-hash :url="''">
            {{ $award->name }}
        </x-tag-hash>
    @endforeach
    <x-tag-hash :url="''">
        {{ $work->location_city }}
    </x-tag-hash>

    <x-tag-hash :url="''">
        {{ $work->date_design_start }}
    </x-tag-hash>
</div>
