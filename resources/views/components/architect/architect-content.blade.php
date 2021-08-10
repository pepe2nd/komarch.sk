<div class="post-content mx-auto mb-5">

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
        </x-attribute-with-label>
    @endif


</div>

