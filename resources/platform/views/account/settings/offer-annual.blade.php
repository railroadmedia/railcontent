@extends('account.settings.offer-layout')

@section('offer-content')

<div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 tw-gap-4 tw-mb-8">
    
    {{-- Card One --}}
    <div class="tw-border tw-border-[#445F74] tw-rounded-md">
        {{-- Card Header --}}
        <div class="tw-bg-[#102230] tw-p-6 tw-flex tw-flex-col tw-items-center">
            <svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg" class="tw-mb-2">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.10226 0C1.07659 0 0.245117 0.831472 0.245117 1.85714V24.1429C0.245117 25.1685 1.07659 26 2.10226 26H10.4594C11.4851 26 12.3165 25.1685 12.3165 24.1429V1.85714C12.3165 0.831471 11.4851 0 10.4594 0H2.10226ZM3.03083 1.92593C2.518 1.92593 2.10226 2.34166 2.10226 2.8545V23.1455C2.10226 23.6583 2.518 24.0741 3.03083 24.0741H9.53083C10.0437 24.0741 10.4594 23.6583 10.4594 23.1455V2.8545C10.4594 2.34166 10.0437 1.92593 9.53083 1.92593H3.03083Z" fill="white"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.9594 0C15.9337 0 15.1023 0.831472 15.1023 1.85714V24.1429C15.1023 25.1685 15.9337 26 16.9594 26H25.3165C26.3422 26 27.1737 25.1685 27.1737 24.1429V1.85714C27.1737 0.831471 26.3422 0 25.3165 0H16.9594ZM17.888 1.92593C17.3751 1.92593 16.9594 2.34166 16.9594 2.8545V23.1455C16.9594 23.6583 17.3751 24.0741 17.888 24.0741H24.388C24.9008 24.0741 25.3165 23.6583 25.3165 23.1455V2.8545C25.3165 2.34166 24.9008 1.92593 24.388 1.92593H17.888Z" fill="white"/>
            </svg>
            <h3 class="tw-font-bold tw-text-xl">Pause your account</h3>
        </div>
        {{-- Card Body --}}
        <div class="tw-p-6 tw-flex tw-flex-col">
            <div>
                <div class="">
                    <p class="tw-mb-6 tw-font-semibold">We know life gets busy. But instead of giving up your progress, pause your account and come
                        back when you're ready.
                    </p>
                    <p class="tw-mb-4 tw-font-semibold">Pause your account:</p>
                </div>
            </div>

            <form method="post"
                action="{{ url()->route('platform.profile.settings.accept-pause-offer') }}"
                id="pause-offer-form"
                class="tw-flex tw-flex-col tw-flex-grow"
            >
                {{ csrf_field() }}

                <ul class="tw-flex tw-mb-6 tw-justify-center tw-items-center">
                    <li class="tw-mr-2 tw-w-full">
                        <input type="radio" name="pause-length" id="30-day-pause" value="30"
                                class="tw-hidden tw-peer">
                        <label class="peer-checked:tw-bg-[#445F74]/60 tw-p-3 tw-font-bold tw-uppercase tw-rounded-full tw-border-2 tw-border-[#445F74] tw-inline-flex tw-w-full tw-justify-center tw-cursor-pointer tw-transition-colors hover:tw-bg-[#445F74]/60" for="30-day-pause">30 days</label>
                    </li>
                    <li class="tw-mr-2 tw-w-full">
                        <input type="radio" name="pause-length" id="60-day-pause" value="60"
                                class="tw-hidden tw-peer">
                        <label class="peer-checked:tw-bg-[#445F74]/60 tw-p-3 tw-font-bold tw-uppercase tw-rounded-full tw-border-2 tw-border-[#445F74] tw-inline-flex tw-w-full tw-justify-center tw-cursor-pointer tw-transition-colors hover:tw-bg-[#445F74]/60" for="60-day-pause">60 days</label>
                    </li>
                    <li class="tw-mr-2 tw-w-full">
                        <input type="radio" name="pause-length" id="90-day-pause" value="90"
                                class="tw-hidden tw-peer">
                        <label class="peer-checked:tw-bg-[#445F74]/60 tw-p-3 tw-font-bold tw-uppercase tw-rounded-full tw-border-2 tw-border-[#445F74] tw-inline-flex tw-w-full tw-justify-center tw-cursor-pointer tw-transition-colors hover:tw-bg-[#445F74]/60" for="90-day-pause">90 days</label>
                    </li>
                </ul>

                <button
                    type="submit"
                    class="tw-btn-primary tw-bg-white tw-text-[#000C17] tw-mx-auto tw-px-8"
                >
                    Pause Membership
                </button>
            </form>
            
        </div>
    </div>

    {{-- Card Two --}}
    @include('account.settings.offer-switch-to-monthly')

</div>

@endsection

