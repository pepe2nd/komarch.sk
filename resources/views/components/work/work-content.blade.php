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

    @if ($work->functions->count() > 0)
        <div class="mb-9">
            <div class="mb-1">{{ __('works.typology_of_the_work') }}:</div>
            @foreach ($work->functions as $function)
                <x-link-arrow url="{{ route('works', ['function' => $function->name]) }}">
                    {{ $function->name }}
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
                    {{ $award->name }}
                </x-link-arrow>
            @endforeach
        </div>
    @endif

    @if ($work->other_architects->count() > 0)
        <div class="mb-9">
            <div class="mb-1">{{ __('works.authors') }}:</div>
            {{ $work->other_architects->implode('name', ', ') }}
        </div>
    @endif


    <div class="mb-9">
        <div class="mb-1">{{ __('works.about_the_work') }}:</div>
        {!! nl2br($work->annotation) !!}
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
