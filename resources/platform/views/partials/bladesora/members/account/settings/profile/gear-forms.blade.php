<div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 md:tw-grid-cols-4 tw-gap-4">
    
    {{-- DRUMS --}}
    @include('partials.bladesora.members.account.settings.profile.gear-form-drums', [
        'brand' => 'drumeo',
        'drummingSince' => user()->getDrumsPlayingSinceYear(),
        'drums' => user()->getDrumsGearSetBrands(),
        'cymbals' => user()->getDrumsGearCymbalBrands(),
        'hardware' => user()->getDrumsGearHardwareBrands(),
        'sticks' => user()->getDrumsGearStickBrands(),

        'method' => 'patch',
        'action' => '/usora/user/update/' . user()->id . '/',
        'drummingSinceInput' => [
            'inputName' => 'drums_playing_since_year',
            'inputValue' => old('drums_playing_since_year', user()->getDrumsPlayingSinceYear() ?? ''),
            'inputErrors' => $errors->get('drums_playing_since_year'),
        ],
        'drumSetInput' => [
            'inputName' => 'drums_gear_set_brands',
            'inputValue' => old('drums_gear_set_brands', user()->getDrumsGearSetBrands() ?? ''),
            'inputErrors' => $errors->get('drums_gear_set_brands'),
        ],
        'cymbalsInput' => [
            'inputName' => 'drums_gear_cymbal_brands',
            'inputValue' => old('drums_gear_cymbal_brands', user()->getDrumsGearCymbalBrands() ?? ''),
            'inputErrors' => $errors->get('drums_gear_cymbal_brands'),
        ],
        'hardwareInput' => [
            'inputName' => 'drums_gear_hardware_brands',
            'inputValue' => old('drums_gear_hardware_brands', user()->getDrumsGearHardwareBrands() ?? ''),
            'inputErrors' => $errors->get('drums_gear_hardware_brands'),
        ],
        'sticksInput' => [
            'inputName' => 'drums_gear_stick_brands',
            'inputValue' => old('drums_gear_stick_brands', user()->getDrumsGearStickBrands() ?? ''),
            'inputErrors' => $errors->get('drums_gear_stick_brands'),
        ]
    ])

    {{-- PIANO --}}
    @include('partials.bladesora.members.account.settings.profile.gear-form-piano', [
        'brand' => '{{ $brand }}',
        'playingSince' => user()->getPianoPlayingSinceYear(),
        'piano' => user()->getPianoGearPianoBrands(),
        'keyboard' => user()->getPianoGearKeyboardBrands(),
        'gearPhoto' => user()->getPianoGearPhoto(),

        'method' => 'patch',
        'action' => '/usora/user/update/' . user()->id,
        'playedSinceInput' => [
            'inputName' => 'piano_playing_since_year',
            'inputValue' => old('piano_playing_since_year', user()->getPianoPlayingSinceYear() ?? ''),
            'inputErrors' => $errors->get('piano_playing_since_year'),
        ],
        'pianoBrandInput' => [
            'inputName' => 'piano_gear_piano_brands',
            'inputValue' => old('piano_gear_piano_brands', user()->getPianoGearPianoBrands() ?? ''),
            'inputErrors' => $errors->get('piano_gear_piano_brands'),
        ],
        'keyboardBrandInput' => [
            'inputName' => 'piano_gear_keyboard_brands',
            'inputValue' => old('piano_gear_keyboard_brands', user()->getPianoGearKeyboardBrands() ?? ''),
            'inputErrors' => $errors->get('piano_gear_keyboard_brands'),
        ],
        'gearInput' => [
            'inputName' => 'piano_gear_photo',
            'inputValue' => old('piano_gear_photo', user()->getPianoGearPhoto() ?? ''),
            'inputErrors' => $errors->get('piano_gear_photo'),
        ]
    ])

    {{-- GUITAREO --}}
    @include('partials.bladesora.members.account.settings.profile.guitar-gear-form', [
        'brand' => 'guitareo',
        'playedGuitarSince' => user()->getGuitarPlayingSinceYear(),
        'guitars' => user()->getGuitarGearGuitarBrands(),
        'amps' => user()->getGuitarGearAmpBrands(),
        'pedals' => user()->getGuitarGearPedalBrands(),
        'strings' => user()->getGuitarGearStringBrands(),
        'gearPhoto' => user()->getGuitarGearPhoto(),

        'method' => 'patch',
        'action' => '/usora/user/update/' . user()->id,
        'playedGuitarSinceInput' => [
            'inputName' => 'guitar_playing_since_year',
            'inputValue' => old('guitar_playing_since_year', user()->getGuitarPlayingSinceYear() ?? ''),
            'inputErrors' => $errors->get('guitar_playing_since_year'),
        ],
        'guitarsInput' => [
            'inputName' => 'guitar_gear_guitar_brands',
            'inputValue' => old('guitar_gear_guitar_brands', user()->getGuitarGearGuitarBrands() ?? ''),
            'inputErrors' => $errors->get('guitar_gear_guitar_brands'),
        ],
        'ampsInput' => [
            'inputName' => 'guitar_gear_amp_brands',
            'inputValue' => old('guitar_gear_amp_brands', user()->getGuitarGearAmpBrands() ?? ''),
            'inputErrors' => $errors->get('guitar_gear_amp_brands'),
        ],
        'pedalsInput' => [
            'inputName' => 'guitar_gear_pedal_brands',
            'inputValue' => old('guitar_gear_pedal_brands', user()->getGuitarGearPedalBrands() ?? ''),
            'inputErrors' => $errors->get('guitar_gear_pedal_brands'),
        ],
        'stringsInput' => [
            'inputName' => 'guitar_gear_string_brands',
            'inputLabel' => 'Strings',
            'inputValue' => old('guitar_gear_string_brands', user()->getGuitarGearStringBrands() ?? ''),
            'inputErrors' => $errors->get('guitar_gear_string_brands'),
        ],
        'gearInput' => [
            'inputName' => 'guitar_gear_photo',
            'inputValue' => old('guitar_gear_photo', user()->getGuitarGearPhoto()),
            'inputErrors' => $errors->get('guitar_gear_photo'),
        ]
    ])

    {{-- SINGEO --}}
    @include('partials.bladesora.members.account.settings.profile.gear-form-piano', [
        'brand' => '{{ $brand }}',
        'singingSince' => user()->getSingingSinceYear(),
        'mic' => user()->getSingingGearMicBrands(),

        'method' => 'patch',
        'action' => '/usora/user/update/' . user()->id,
        'playedSinceInput' => [
            'inputName' => 'singing_since_year',
            'inputValue' => old('singing_since_year', user()->getSingingSinceYear() ?? ''),
            'inputErrors' => $errors->get('singing_since_year'),
        ],
        'pianoBrandInput' => [
            'inputName' => 'singing_gear_mic_brands',
            'inputValue' => old('singing_gear_mic_brands', user()->getSingingGearMicBrands() ?? ''),
            'inputErrors' => $errors->get('singing_gear_mic_brands'),
        ]
    ])
</div>