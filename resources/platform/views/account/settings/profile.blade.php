@extends('account.settings.layout')

@section('meta')
    <title>Profile | Musora</title>
@endsection

@section('layout-scripts')
    @parent
    <script src="https://cdn.tiny.cloud/1/g84168rl7b45du7fji2nive374o541mhtmzogyolgqng97xc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ mix('assets/members/js/profile.js') }}"></script>
@endsection

@section('edit-forms')
    <input id="userInfo" type="hidden" data-user-id="{{ auth()->id() }}">

    <div class="tw-flex tw-flex-row pa-3 tw-flex-auto">
        <h1 class="heading">Profile</h1>
    </div>
    <div id="editForm" class="tw-flex tw-flex-row">
        <div class="tw-flex tw-flex-column tw-grow">
            <div class="tw-flex tw-flex-row pa-3 tw-flex-auto bt-grey-1-1">
                @include('partials.bladesora.members.account.settings.profile.display-name-form', [
                    'brand' => '{{ $brand }}',
                    'method' => 'patch',
                    'action' => '/usora/user/update/' . current_user()->getId(),
                    'displayName' => current_user()->getDisplayName(),
                    'displayNameInput' => [
                        'inputErrors' => $errors->get('display_name'),
                        'inputValue' => old('display_name', current_user()->getDisplayName()),
                    ],
                ])
            </div>

            <div class="tw-flex tw-flex-row pa-3 tw-flex-auto bt-grey-1-1">
                @include('partials.bladesora.members.account.settings.profile.avatar-form', [
                    'brand' => '{{ $brand }}',
                    'method' => 'POST',
                    'profilePictureUrl' => current_user()->getProfilePictureUrl(),
                    'uploadRequestEndpoint' => '/avatar/upload',
                    'fieldSaveRequestEndpoint' => '/usora/json-api/user/update/'  . current_user()->getId(),
                    'userId' => current_user()->getId(),
                    'canClearAvatar' => stripos(current_user()->getProfilePictureUrl(), 'defaults') === false
                ])
            </div>

            <div class="tw-flex tw-flex-row pa-3 tw-flex-auto bt-grey-1-1">
                @include('partials.bladesora.members.account.settings.profile.about-form', [
                    'brand' => '{{ $brand }}',
                    'fullName' => current_user()->getFirstName() . ' ' . current_user()->getLastName(),
                    'firstName' => current_user()->getFirstName(),
                    'lastName' => current_user()->getLastName(),
                    'country' => current_user()->getCountry(),
                    'birthday' => current_user()->getBirthday(),
                    'biography' => nl2br(current_user()->getBiography()),
                    'displayName' => current_user()->getDisplayName(),
                    'method' => 'patch',
                    'action' => '/usora/user/update/' . current_user()->getId(),
                    'firstNameInput' => [
                        'inputName' => 'first_name',
                        'inputValue' => old('first_name', current_user()->getFirstName()),
                        'inputErrors' => $errors->get('first_name')
                    ],
                    'lastNameInput' => [
                        'inputName' => 'last_name',
                        'inputValue' => old('last_name', current_user()->getLastName()),
                        'inputErrors' => $errors->get('last_name')
                    ],
                    'countryInput' => [
                        'inputName' => 'country',
                        'inputValue' => old('country', current_user()->getCountry()),
                        'inputErrors' => $errors->get('country'),
                        'inputOptions' => countries()
                    ],
                    'birthdayInput' => [
                        'inputName' => 'birthday',
                        'inputValue' => old('birthday', current_user()->getBirthday()),
                        'inputErrors' => $errors->get('birthday')
                    ],
                    'biographyInput' => [
                        'inputName' => 'biography',
                        'inputValue' => old('biography', current_user()->getBiography()),
                        'inputErrors' => $errors->get('biography')
                    ]
                ])
            </div>

{{--            <div class="tw-flex tw-flex-row pa-3 tw-flex-auto bt-grey-1-1">--}}
{{--                @include('partials.bladesora.members.account.settings.profile.piano-gear-form', [--}}
{{--                    'brand' => '{{ $brand }}',--}}
{{--                    'playingSince' => current_user()->getPianoPlayingSinceYear(),--}}
{{--                    'piano' => current_user()->getPianoGearPianoBrands(),--}}
{{--                    'keyboard' => current_user()->getPianoGearKeyboardBrands(),--}}
{{--                    'gearPhoto' => current_user()->getPianoGearPhoto(),--}}

{{--                    'method' => 'patch',--}}
{{--                    'action' => '/usora/user/update/' . current_user()->getId(),--}}
{{--                    'playedSinceInput' => [--}}
{{--                        'inputName' => 'piano_playing_since_year',--}}
{{--                        'inputValue' => old('piano_playing_since_year', current_user()->getPianoPlayingSinceYear() ?? ''),--}}
{{--                        'inputErrors' => $errors->get('piano_playing_since_year'),--}}
{{--                    ],--}}
{{--                    'pianoBrandInput' => [--}}
{{--                        'inputName' => 'piano_gear_piano_brands',--}}
{{--                        'inputValue' => old('piano_gear_piano_brands', current_user()->getPianoGearPianoBrands() ?? ''),--}}
{{--                        'inputErrors' => $errors->get('piano_gear_piano_brands'),--}}
{{--                    ],--}}
{{--                    'keyboardBrandInput' => [--}}
{{--                        'inputName' => 'piano_gear_keyboard_brands',--}}
{{--                        'inputValue' => old('piano_gear_keyboard_brands', current_user()->getPianoGearKeyboardBrands() ?? ''),--}}
{{--                        'inputErrors' => $errors->get('piano_gear_keyboard_brands'),--}}
{{--                    ],--}}
{{--                    'gearInput' => [--}}
{{--                        'inputName' => 'piano_gear_photo',--}}
{{--                        'inputValue' => old('piano_gear_photo', current_user()->getPianoGearPhoto() ?? ''),--}}
{{--                        'inputErrors' => $errors->get('piano_gear_photo'),--}}
{{--                    ]--}}
{{--                ])--}}
{{--            </div>--}}

{{--            <div class="tw-flex tw-flex-row pa-3 tw-flex-auto bt-grey-1-1">--}}
{{--                @include('partials.bladesora.members.account.settings.profile.gear-photo-form', [--}}
{{--                    'brand' => '{{ $brand }}',--}}
{{--                    'method' => 'POST',--}}
{{--                    'gearPhotoUrl' => current_user()->getPianoGearPhoto(),--}}
{{--                    'uploadRequestEndpoint' => '/avatar/upload',--}}
{{--                    'fieldSaveRequestEndpoint' => '/usora/json-api/user/update',--}}
{{--                    'userId' => current_user()->getId(),--}}
{{--                    'canClear' => !empty(current_user()->getPianoGearPhoto())--}}
{{--                ])--}}
{{--            </div>--}}

            <div class="tw-flex tw-flex-row pa-3 tw-flex-auto bt-grey-1-1">
                <h1 id="signatureForm"></h1>
                @include('partials.bladesora.members.account.settings.profile.signature-form', [
                    'brand' => '{{ $brand }}',
                    'method' => 'patch',
                    'action' => '/signature/update/' . current_user()->getId(). '?redirect=' . url()->route('members.profile.settings'),
                    'signature' => $signature,
                    'displayName' => current_user()->getDisplayName(),
                    'displayNameInput' => [
                        'inputErrors' => $errors->get('display_name'),
                        'inputValue' => old('display_name', current_user()->getDisplayName()),
                    ],
                ])
            </div>

        </div>
    </div>
@endsection
