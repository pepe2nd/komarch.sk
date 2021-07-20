<div class="post-content mx-auto mt-10 mb-5">
    {!! $contest->perex !!}
</div>

<div class="post-content mx-auto mb-5">
    <h3 class="mb-3">{{ __('contests.participation_conditions') }}:</h3>
    {!! $contest->participation_conditions !!}
</div>

{{-- terminy --}}
<div class="post-content mx-auto mb-5">
    <h3 class="mb-3">{{ __('contests.terms') }}:</h3>

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

<div class="post-content mx-auto mb-5">
    {!! $contest->note !!}
</div>

<div class="post-content mx-auto mb-5">
    <h3 class="mb-3">{{ __('contests.jurors') }}:</h3>

    {{-- types: r-riadny/n-nahradnik/e-expert/o-overovatel za komoru --}}
    @foreach (['r', 'e', 'n'] as $type)
        @if (($contest->architects->where('pivot.type', $type)->count() > 0) || ($contest->jurors->where('type', $type)->count() > 0))
            <h4 class="my-3">{{ __('contests.jurors.' . $type) }}:</h4>
            @foreach ($contest->architects->where('pivot.type', $type) as $architect)
                <x-link-architect url="{{ $architect->url }}" external>{{ $architect->full_name }}</x-link-architect><br>
            @endforeach
            @foreach ($contest->jurors->where('type', $type) as $juror)
                {{ $juror->name }}<br>
            @endforeach
        @endif
    @endforeach

</div>

{{-- architect_contest / clenovia - iba "r, n, e" +  jurors / neclenovia  -> zoskupit podla "type" --}}

{{-- rewards / ceny -> podla poradia --}}

{{-- web_terms --}}
{{-- web_results --}}

{{-- media - contest_attachments --}}