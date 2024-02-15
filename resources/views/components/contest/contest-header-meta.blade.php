<div class="flex flex-wrap items-center">

    <span class="whitespace-nowrap">
        @if ($contest->in_verification)
            <span class="text-gray-500">{{ __('contests.in_verification') }}</span>
        @elseif ($contest->nextProposal && $contest->nextProposal->date)
            {{ $contest->announced_at->format(config('settings.date_short_without_year_format')) }} – {{ $contest->nextProposal->date->format(config('settings.date_short_format')) }}
        @elseif ($contest->finished_at)
            {{ $contest->announced_at->format(config('settings.date_short_without_year_format')) }} – {{ $contest->finished_at->format(config('settings.date_short_format')) }}
        @elseif ($contest->announced_at)
            {{ $contest->announced_at->format(config('settings.date_short_format'))  }}
        @endif
    </span>

    <span class="ml-2 lg:ml-10">
        @if($contest->nextProposal && $contest->nextProposal->date)
            <span class="icon-clock mr-1" />
            <span title="{{ $contest->nextProposal->date->format(config('settings.date_short_format')) }}">
                {!! $contest->nextProposal->date->diffForHumans() !!}
            </span>
        @endif
    </span>
</div>
