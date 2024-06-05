@extends('partials.layout')

@section('meta')
    <title>Profile | Musora</title>
@endsection

{{-- @section('layout-scripts')
    @parent
    <script src="https://cdn.tiny.cloud/1/g84168rl7b45du7fji2nive374o541mhtmzogyolgqng97xc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ mix('platform/js/profile.js') }}"></script>
@endsection --}}

{{-- @section('edit-forms')
    <input id="userInfo" type="hidden" data-user-id="{{ auth()->id() }}">

    <div id="editForm" class="tw-flex tw-flex-row">
        <div class="tw-flex tw-flex-col tw-grow">

            {{-- $section --}}

            {{-- AVATAR PHOTO --}}
            {{-- <div class="tw-flex tw-flex-row pa-3 tw-flex-auto tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                @include('partials.bladesora.members.account.settings.profile.avatar-form', [
                    'brand' => '{{ $brand }}',
                    'method' => 'POST',
                    'profilePictureUrl' => user()->profile_picture_url,
                    'uploadRequestEndpoint' => '/user-management-system/picture/upload',
                    'fieldSaveRequestEndpoint' => '/user-management-system/user/update/'  . user()->id,
                    'userId' => user()->id,
                    'canClearAvatar' => stripos(user()->profile_picture_url, 'defaults') === false
                ])
            </div> --}}

            {{-- GEAR PHOTOS --}}
            {{-- <div class="tw-flex tw-flex-col pa-3 tw-w-full tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                @include('partials.bladesora.members.account.settings.profile.gear-photos', [
                    'brand' => $brand
                ])
            </div> --}}

            {{-- SIGNATURE --}}
            {{-- <div class="tw-flex tw-flex-row pa-3 tw-flex-auto tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                <h1 id="signatureForm"></h1>

                @include('partials.bladesora.members.account.settings.profile.signature-form', [
                    'brand' => '{{ $brand }}',
                    'method' => 'patch',
                    'action' => url()->route('railforums.signature.update',['id' => user()->id]),
                    'signature' => $signature,
                    'displayName' => user()->display_name,
                    'displayNameInput' => [
                        'inputErrors' => $errors->get('display_name'),
                        'inputValue' => old('display_name', user()->display_name),
                    ],
                ])
            </div> --}}

        {{-- </div>
    </div>
@endsection  --}}

@section('content')
    {{-- Profile Page Component --}}
    <profile
        user-forum-signature="{{ $signature }}"
        :country-list="{{ json_encode(\Railroad\Location\Services\CountryListService::allWithCommonDuplicatedAtTop()) }}"
    ></profile>
@endsection