<div class="post-content mx-auto mt-10 mb-10">
    {!! $contest->perex !!}
</div>

<div class="post-content mx-auto mb-10">
    <x-label>{{ __('contests.participation_conditions') }}:</x-label>
    {!! $contest->participation_conditions !!}
</div>

{{-- terminy --}}
<div class="post-content mx-auto mb-10">
    <x-label>{{ __('contests.terms') }}:</x-label>

    @if ($contest->announced_at)
        <div class="mb-3">
            {{ __('contests.announced_at') }}:
            @date_localized($contest->announced_at)
        </div>
    @endif


    @if ($contest->proposals->count() > 0)
        <div class="mb-3">
            {{ __('contests.proposal_at') }}:
            @foreach ($contest->proposals as $proposal)
                @date_localized($proposal->date){{ ($loop->last) ? '' : ', ' }}
            @endforeach
        </div>
    @endif

    @if ($contest->finished_at)
        <div class="mb-3">
            {{ __('contests.finished_at') }}:
            @date_localized($contest->finished_at)
        </div>
    @endif

    @if ($contest->results_published_at)
        <div class="mb-3">
            {{ __('contests.results_published_at') }}:
            @date_localized($contest->results_published_at)
        </div>
    @endif

</div>

<div class="post-content mx-auto mb-10">
    <x-label>{{ __('contests.jurors') }}:</x-label>
    {{-- types: r-riadny/n-nahradnik/e-expert/o-overovatel za komoru --}}
    @foreach (['p', 'r', 'n', 'e'] as $type)
        @if (($contest->architects->where('pivot.type', $type)->count() > 0) || ($contest->jurors->where('type', $type)->count() > 0))
            <h4 class="mb-4">{{ __('contests.jurors.' . $type) }}:</h4>
            <div class="leading-relaxed mb-10">
                @foreach ($contest->architects->where('pivot.type', $type) as $architect)
                    <x-link-architect url="{{ $architect->url }}" external>{{ $architect->full_name }}</x-link-architect>
                    @if ($architect->pivot->depended)
                        &nbsp;({{ __('contests.depended') }})
                    @endif
                    <br>
                @endforeach
                @foreach ($contest->jurors->where('type', $type) as $juror)
                    {{ $juror->name }}
                    @if ($juror->depended)
                        &nbsp;({{ __('contests.depended') }})
                    @endif
                    <br>
                @endforeach
            </div>
        @endif
    @endforeach
</div>

{{-- rewards --}}
<div class="post-content mx-auto mb-10">
    @if ($contest->rewards->count() > 0)
        <x-label>{{ __('contests.rewards') }}:</x-label>
        <div class="mb-3">
        @foreach ($contest->rewards as $reward)
            {{ $reward->name }}: @money($reward->amount)<br>
        @endforeach
        </div>
    @endif
</div>


<div class="post-content mx-auto mb-10">
    @if ($contest->web_terms)
    <div>
        {{ __('contests.web_terms') }}:
        <x-link-arrow url="{{ $contest->web_terms }}" external>
            {{ $contest->web_terms }}
        </x-link-arrow>
    </div>
    @endif

    @if ($contest->web_results)
    <div>
        {{ __('contests.web_results') }}:
        <x-link-arrow url="{{ $contest->web_results }}" external>
            {{ $contest->web_results }}
        </x-link-arrow>
    </div>
    @endif
</div>

<div class="post-content mx-auto mb-10">
    @foreach ($contest->attachments as $attachment)
        <x-link-download url="{{ $attachment->getUrl() }}">
            {{ $attachment->name }}
        </x-link-download>
    @endforeach
</div>

{{-- reward results--}}
<div class="post-content mx-auto mb-10">
    @if ($contest->results->count() > 0)
        <x-label>{{ __('contests.results') }}:</x-label>
        @foreach ($contest->rewards as $reward)
            @if ($reward->result)
                <h4 class="text-2xl tracking-tight leading-snug my-5 lg:my-12">
                    {{ $reward->name }} (@money($reward->amount))
                    –
                    {{ $reward->result->subject_name }}
                </h4>

                {{-- architects --}}
                @if (($reward->result->architects->count() > 0) || ($reward->result->other_architects->count() > 0))
                    <div class="mb-3">{{ __('works.authors') }}:</div>

                    <div class="mb-9">
                        @foreach ($reward->result->architects as $architect)
                            <x-link-architect url="{{ $architect->url }}" external>{{ $architect->full_name }}</x-link-architect>{{ ($loop->last && !($reward->result->other_architects->count() > 0)) ? '' : ', ' }}
                        @endforeach
                        {{ $reward->result->other_architects->implode('name', ', ') }}
                    </div>
                @endif
                {{-- /architects --}}

                <div class="mb-3">{{ __('contests.jury_comment') }}:</div>
                <div class="mb-3">
                    {!! $reward->result->jury_comment !!}
                </div>
                <image-gallery class="mt-10 mb-16" source-url="contest-results/{{ $reward->result->id }}/images"></image-gallery>
            @endif
        @endforeach
    @endif
</div>

{{-- data z contestresults  --}}
{{-- contestresults.reward. (napr. 1. mestio) : --}}
