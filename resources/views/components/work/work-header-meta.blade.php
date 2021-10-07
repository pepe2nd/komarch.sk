<div class="flex mt-14">
    @foreach ($work->awards as $award)
        <x-tag-hash :url="route('works', ['awards[]' => $award->name])">
            {{ $award->name }}
        </x-tag-hash>
    @endforeach
    @if ($work->location_district)
        <x-tag-hash :url="route('works', ['location_districts[]' => $work->location_district])">
            {{ $work->location_district }}
        </x-tag-hash>
    @endif

    @if ($work->date_design_start)
        <x-tag-hash :url="route('works', ['year_from[]' => $work->date_design_start])">
            {{ $work->date_design_start }}
        </x-tag-hash>
    @endif
</div>
