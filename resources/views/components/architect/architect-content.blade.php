<div class="grid md:grid-cols-2 mx-auto post-content my-8 lg:my-16">
    <div>
        @if ($architect->number)
            <x-attribute-with-label :label="__('architects.registration_number')">
                {{ $architect->number->architect_number }}
            </x-attribute-with-label>
        @endif

        @if ($architect->address)
            <x-attribute-with-label :label="__('architects.location')">
                {{ $architect->address->location_city }}
            </x-attribute-with-label>

            <x-attribute-with-label :label="__('architects.contact')">
                @if ($architect->address->phone)
                    {{ $architect->address->phone }}<br>
                @endif
                @if ($architect->address->mobile)
                    {{ $architect->address->mobile }}<br>
                @endif
                @if ($architect->address->email)
                    <x-link-arrow-hover url="mailto:{{ $architect->address->email }}">
                        {{ __('architects.send_email') }}
                    </x-link-arrow-hover>
                @endif
                @if ($architect->webpage)
                    <x-link-arrow-hover url="{{ $architect->webpage_url }}" target="_blank">
                        {{ $architect->webpage }}
                    </x-link-arrow-hover>
                @endif
            </x-attribute-with-label>
        @endif
    </div>

    <div>
        @if ($architect->address)
            <x-attribute-with-label :label="__('architects.address')">
                <x-link-arrow url="https://www.google.com/maps/search/?api=1&query={{ urlencode($architect->address->formated) }}" target="_blank">
                    {{ $architect->address->formated }}
                </x-link-arrow>
            </x-attribute-with-label>
        @endif

        @if ($architect->awards->count() > 0)
            <x-attribute-with-label :label="__('architects.awards')">
                {{ $architect->awards->implode('name', ', ') }}
            </x-attribute-with-label>
        @endif

        @if ($architect->contests->count() > 0)
            <x-attribute-with-label :label="__('architects.contests')">
                @foreach ($architect->contests as $contest)
                    <x-link-arrow url="{{ $contest->url }}">{{ $contest->title }}</x-link-arrow>
                @endforeach
            </x-attribute-with-label>
        @endif
    </div>
</div>