<div class="tw-flex tw-flex-row tw-flex-auto tw-items-center tw-mb-4">
    <div class="tw-flex tw-flex-col">
        <h2 class="tw-text-2xl tw-font-bold dark:tw-text-white">Gear Photos</h2>
    </div>
</div>
<div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-3 2xl:tw-grid-cols-4 tw-gap-4">
    
    {{-- DRUMS --}}
    @include('partials.bladesora.members.account.settings.profile.photo-form-drums', [
        'brand' => '{{ $brand }}',
        'method' => 'patch',
        'gearPhotoUrl' => user()->drums_gear_photo,
        'uploadRequestEndpoint' => '/user-management-system/user/update/' . user()->id,
        'userId' => user()->id,
        'canClear' => !empty(user()->drums_gear_photo)
    ])

    {{-- PIANO --}}
    @include('partials.bladesora.members.account.settings.profile.photo-form-piano', [
        'brand' => '{{ $brand }}',
        'method' => 'patch',
        'gearPhotoUrl' => user()->piano_gear_photo,
        'uploadRequestEndpoint' => '/user-management-system/user/update/' . user()->id,
        'userId' => user()->id,
        'canClear' => !empty(user()->piano_gear_photo)
    ])

    {{-- GUITAREO --}}
    @include('partials.bladesora.members.account.settings.profile.photo-form-guitars', [
        'brand' => '{{ $brand }}',
        'method' => 'patch',
        'gearPhotoUrl' => user()->guitar_gear_photo,
        'uploadRequestEndpoint' => '/user-management-system/user/update/' . user()->id,
        'userId' => user()->id,
        'canClear' => !empty(user()->guitar_gear_photo)
    ])

    {{-- SINGEO --}}
    @include('partials.bladesora.members.account.settings.profile.photo-form-singing', [
        'brand' => '{{ $brand }}',
        'method' => 'patch',
        'gearPhotoUrl' => user()->singing_gear_photo,
        'uploadRequestEndpoint' => '/user-management-system/user/update/' . user()->id,
        'userId' => user()->id,
        'canClear' => !empty(user()->singing_gear_photo)
    ])
</div>
<div class="flex flex-column tw-py-4">
    <p class="tw-text-sm text-grey-3 tw-italic dark:tw-text-[#9EC0DC]">For best results upload photo larger than 1280x720.</p>
    <p class="tw-text-sm text-grey-3 tw-italic dark:tw-text-[#9EC0DC]">Max file size: <strong>5MB</strong></p>
</div>
