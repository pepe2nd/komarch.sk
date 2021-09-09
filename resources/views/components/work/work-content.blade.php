<div class="post-content mx-auto mt-10">
    @if ($work->date_design)
        <div class="mb-9">
            <div class="mb-1">{{ __('works.design_year') }}:</div>
            {{ $work->date_design }}
        </div>
    @endif

    @if ($work->date_construction)
        <div class="mb-9">
            <div class="mb-1">{{ __('works.realisation_year') }}:</div>
            {{ $work->date_construction }}
        </div>
    @endif

    @if ($work->typologies->count() > 0)
        <div class="mb-9">
            <div class="mb-1">{{ __('works.typology_of_the_work') }}:</div>
            @foreach ($work->typologies as $typology)
                <x-link-arrow url="{{ route('works', ['typologies[]' => $typology->name]) }}">
                    {{ $typology->name }}
                </x-link-arrow>
            @endforeach
        </div>
    @endif

    @if ($work->location)
        <div class="mb-9">
            <div class="mb-1">{{ __('works.address') }}:</div>
            {{ $work->location }}
        </div>
    @endif

    @if ($work->awards->count() > 0)
        <div class="mb-9">
            <div class="mb-1">{{ __('works.awards') }}:</div>
            @foreach ($work->awards as $award)
                <x-link-arrow url="{{ route('works', ['award' => $award->name]) }}">
                    {{ $award->name }} ({{ $award->pivot->year }})
                </x-link-arrow>
            @endforeach
        </div>
    @endif

    @if (($work->architects->count() > 0) || ($work->other_architects->count() > 0))
        <div class="mb-9">
            <div class="mb-1">{{ __('works.authors') }}:</div>

            @foreach ($work->architects as $architect)
                <x-link-architect url="{{ $architect->url }}" external>{{ $architect->full_name }}</x-link-architect>{{ ($loop->last && !($work->other_architects->count() > 0)) ? '' : ', ' }}
            @endforeach
            {{ $work->other_architects->implode('name', ', ') }}
        </div>
    @endif

    <div class="mb-9">
        <div class="mb-1">{{ __('works.about_the_work') }}:</div>
        {!! $work->annotation !!}
    </div>

    @if ($work->citationPublications->count() > 0)
        <div class="mb-9">
            <div class="mb-1">{{ __('works.literature') }}:</div>
            @foreach ($work->citationPublications as $publication)
                <x-link-arrow url="{{ route('works', ['publication' => $publication->publication_name]) }}">
                    {{ $publication->publication_name }}
                </x-link-arrow>
            @endforeach
        </div>
    @endif


</div>
