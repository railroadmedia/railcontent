<div class="tw-flex tw-flex-row tw-flex-auto tw-items-center tw-mb-4">
    <div class="tw-flex tw-flex-col">
        <h2 class="tw-text-2xl tw-font-bold dark:tw-text-white">Gear Info</h2>
    </div>
</div>
<div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-3 2xl:tw-grid-cols-4 tw-gap-4">
    {{-- DRUMS --}}
    @include('partials.bladesora.members.account.settings.profile.gear-form-drums', [
        'brand' => 'drumeo',
        'drummingSince' => user()->drums_playing_since_year,
        'drums' => user()->drums_gear_set_brands,
        'cymbals' => user()->drums_gear_cymbal_brands,
        'hardware' => user()->drums_gear_hardware_brands,
        'sticks' => user()->drums_gear_stick_brands,

        'method' => 'patch',
        'action' => '/user-management-system/user/update/' . user()->id,
        'drummingSinceInput' => [
            'inputName' => 'drums_playing_since_year',
            'inputValue' => old('drums_playing_since_year', user()->drums_playing_since_year ?? ''),
            'inputErrors' => $errors->get('drums_playing_since_year'),
        ],
        'drumSetInput' => [
            'inputName' => 'drums_gear_set_brands',
            'inputValue' => old('drums_gear_set_brands', user()->drums_gear_set_brands ?? ''),
            'inputErrors' => $errors->get('drums_gear_set_brands'),
        ],
        'cymbalsInput' => [
            'inputName' => 'drums_gear_cymbal_brands',
            'inputValue' => old('drums_gear_cymbal_brands', user()->drums_gear_cymbal_brands ?? ''),
            'inputErrors' => $errors->get('drums_gear_cymbal_brands'),
        ],
        'hardwareInput' => [
            'inputName' => 'drums_gear_hardware_brands',
            'inputValue' => old('drums_gear_hardware_brands', user()->drums_gear_hardware_brands ?? ''),
            'inputErrors' => $errors->get('drums_gear_hardware_brands'),
        ],
        'sticksInput' => [
            'inputName' => 'drums_gear_stick_brands',
            'inputValue' => old('drums_gear_stick_brands', user()->drums_gear_stick_brands ?? ''),
            'inputErrors' => $errors->get('drums_gear_stick_brands'),
        ]
    ])

    {{-- PIANO --}}
    @include('partials.bladesora.members.account.settings.profile.gear-form-piano', [
        'brand' => '{{ $brand }}',
        'playingSince' => user()->piano_playing_since_year,
        'piano' => user()->piano_gear_piano_brands,
        'keyboard' => user()->piano_gear_keyboard_brands,

        'method' => 'patch',
        'action' => '/user-management-system/user/update/' . user()->id,
        'playedSinceInput' => [
            'inputName' => 'piano_playing_since_year',
            'inputValue' => old('piano_playing_since_year', user()->piano_playing_since_year ?? ''),
            'inputErrors' => $errors->get('piano_playing_since_year'),
        ],
        'pianoBrandInput' => [
            'inputName' => 'piano_gear_piano_brands',
            'inputValue' => old('piano_gear_piano_brands', user()->piano_gear_piano_brands ?? ''),
            'inputErrors' => $errors->get('piano_gear_piano_brands'),
        ],
        'keyboardBrandInput' => [
            'inputName' => 'piano_gear_keyboard_brands',
            'inputValue' => old('piano_gear_keyboard_brands', user()->piano_gear_keyboard_brands ?? ''),
            'inputErrors' => $errors->get('piano_gear_keyboard_brands'),
        ]
    ])

    {{-- GUITAREO --}}
    @include('partials.bladesora.members.account.settings.profile.gear-form-guitar', [
        'brand' => 'guitareo',
        'playedGuitarSince' => user()->guitar_playing_since_year,
        'guitars' => user()->guitar_gear_guitar_brands,
        'amps' => user()->guitar_gear_amp_brands,
        'pedals' => user()->guitar_gear_pedal_brands,
        'strings' => user()->guitar_gear_string_brands,

        'method' => 'patch',
        'action' => '/user-management-system/user/update/' . user()->id,
        'playedGuitarSinceInput' => [
            'inputName' => 'guitar_playing_since_year',
            'inputValue' => old('guitar_playing_since_year', user()->guitar_playing_since_year ?? ''),
            'inputErrors' => $errors->get('guitar_playing_since_year'),
        ],
        'guitarsInput' => [
            'inputName' => 'guitar_gear_guitar_brands',
            'inputValue' => old('guitar_gear_guitar_brands', user()->guitar_gear_guitar_brands ?? ''),
            'inputErrors' => $errors->get('guitar_gear_guitar_brands'),
        ],
        'ampsInput' => [
            'inputName' => 'guitar_gear_amp_brands',
            'inputValue' => old('guitar_gear_amp_brands', user()->guitar_gear_amp_brands ?? ''),
            'inputErrors' => $errors->get('guitar_gear_amp_brands'),
        ],
        'pedalsInput' => [
            'inputName' => 'guitar_gear_pedal_brands',
            'inputValue' => old('guitar_gear_pedal_brands', user()->guitar_gear_pedal_brands ?? ''),
            'inputErrors' => $errors->get('guitar_gear_pedal_brands'),
        ],
        'stringsInput' => [
            'inputName' => 'guitar_gear_string_brands',
            'inputLabel' => 'Strings',
            'inputValue' => old('guitar_gear_string_brands', user()->guitar_gear_string_brands ?? ''),
            'inputErrors' => $errors->get('guitar_gear_string_brands'),
        ],
    ])

    {{-- SINGEO --}}
    {{-- @include('partials.bladesora.members.account.settings.profile.gear-form-singing', [
        'brand' => '{{ $brand }}',
        'singingSince' => user()->getSingingSinceYear(),
        'mic' => user()->getSingingGearMicBrands(),

        'method' => 'patch',
        'action' => '/user-management-system/user/update/' . user()->id,
        'singingSinceInput' => [
            'inputName' => 'singing_since_year',
            'inputValue' => old('singing_since_year', user()->getSingingSinceYear() ?? ''),
            'inputErrors' => $errors->get('singing_since_year'),
        ],
        'micBrandInput' => [
            'inputName' => 'singing_gear_mic_brands',
            'inputValue' => old('singing_gear_mic_brands', user()->getSingingGearMicBrands() ?? ''),
            'inputErrors' => $errors->get('singing_gear_mic_brands'),
        ]
    ]) --}}
</div>