@extends('account.settings.layout')

@section('meta')
    <title>Profile | Musora</title>
@endsection

@section('layout-scripts')
    @parent
    <script src="https://cdn.tiny.cloud/1/g84168rl7b45du7fji2nive374o541mhtmzogyolgqng97xc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('edit-forms')
    <input id="userInfo" type="hidden" data-user-id="{{ auth()->id() }}">

    <div class="tw-flex tw-flex-row pa-3 tw-flex-auto">
        <h1 class="heading">Profile</h1>
    </div>
    <div id="editForm" class="tw-flex tw-flex-row">
        <div class="tw-flex tw-flex-col tw-grow">
            <div class="tw-flex tw-flex-row pa-3 tw-flex-auto bt-grey-1-1">
                @include('partials.bladesora.members.account.settings.profile.display-name-form', [
                    'brand' => '{{ $brand }}',
                    'method' => 'patch',
                    'action' => '/usora/user/update/' . user()->id,
                    'displayName' => user()->display_name,
                    'displayNameInput' => [
                        'inputErrors' => $errors->get('display_name'),
                        'inputValue' => old('display_name', user()->display_name),
                    ],
                ])
            </div>

            <div class="tw-flex tw-flex-row pa-3 tw-flex-auto bt-grey-1-1">
                @include('partials.bladesora.members.account.settings.profile.avatar-form', [
                    'brand' => '{{ $brand }}',
                    'method' => 'POST',
                    'profilePictureUrl' => user()->profile_picture_url,
                    'uploadRequestEndpoint' => '/avatar/upload',
                    'fieldSaveRequestEndpoint' => '/usora/json-api/user/update/'  . user()->id,
                    'userId' => user()->id,
                    'canClearAvatar' => stripos(user()->profile_picture_url, 'defaults') === false
                ])
            </div>

            <div class="tw-flex tw-flex-row pa-3 tw-flex-auto bt-grey-1-1">
                @include('partials.bladesora.members.account.settings.profile.about-form', [
                    'brand' => '{{ $brand }}',
                    'fullName' => user()->first_name . ' ' . user()->last_name,
                    'firstName' => user()->first_name,
                    'lastName' => user()->last_name,
                    'country' => user()->country,
                    'birthday' => user()->birthday,
                    'biography' => nl2br(user()->biography),
                    'displayName' => user()->display_name,
                    'method' => 'patch',
                    'action' => '/usora/user/update/' . user()->id,
                    'firstNameInput' => [
                        'inputName' => 'first_name',
                        'inputValue' => old('first_name', user()->first_name),
                        'inputErrors' => $errors->get('first_name')
                    ],
                    'lastNameInput' => [
                        'inputName' => 'last_name',
                        'inputValue' => old('last_name', user()->last_name),
                        'inputErrors' => $errors->get('last_name')
                    ],
                    'countryInput' => [
                        'inputName' => 'country',
                        'inputValue' => old('country', user()->country),
                        'inputErrors' => $errors->get('country'),
                        'inputOptions' => [] // todo: location package
                    ],
                    'birthdayInput' => [
                        'inputName' => 'birthday',
                        'inputValue' => old('birthday', user()->birthday),
                        'inputErrors' => $errors->get('birthday')
                    ],
                    'biographyInput' => [
                        'inputName' => 'biography',
                        'inputValue' => old('biography', user()->biography),
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
{{--                    'action' => '/usora/user/update/' . user()->id,--}}
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
{{--                    'userId' => user()->id,--}}
{{--                    'canClear' => !empty(current_user()->getPianoGearPhoto())--}}
{{--                ])--}}
{{--            </div>--}}

            <div class="tw-flex tw-flex-row pa-3 tw-flex-auto bt-grey-1-1">
                <h1 id="signatureForm"></h1>
                @include('partials.bladesora.members.account.settings.profile.signature-form', [
                    'brand' => '{{ $brand }}',
                    'method' => 'patch',
                    'action' => '/signature/update/' . user()->id. '?redirect=' . url()->route('platform.profile.settings.profile', ['userId' => user()->id]),
                    'signature' => $signature,
                    'displayName' => user()->display_name,
                    'displayNameInput' => [
                        'inputErrors' => $errors->get('display_name'),
                        'inputValue' => old('display_name', user()->display_name),
                    ],
                ])
            </div>

        </div>
    </div>
@endsection
