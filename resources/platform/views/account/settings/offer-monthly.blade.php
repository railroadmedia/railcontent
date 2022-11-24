@extends('account.settings.offer-layout')

@section('offer-content')

<div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 tw-gap-4 tw-mb-8">
    
    {{-- Card One --}}
    <div class="tw-border tw-border-[#445F74] tw-rounded-md">
        {{-- Card Header --}}
        <div class="tw-bg-[#102230] tw-p-6 tw-flex tw-flex-col tw-items-center">
            <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg" class="tw-mb-2">
                <path d="M16.9326 2.36242L16.1829 3.02415C16.1966 3.03972 16.2108 3.05485 16.2255 3.06953L16.9326 2.36242ZM26.8827 16.6875L26.221 15.9378C26.2054 15.9515 26.1903 15.9657 26.1756 15.9804L26.8827 16.6875ZM27.141 12.5708L27.8907 11.909C27.877 11.8935 27.8627 11.8783 27.8481 11.8636L27.141 12.5708ZM12.8159 26.8958L12.1088 27.6029C12.1234 27.6176 12.1386 27.6318 12.1541 27.6456L12.8159 26.8958ZM16.6744 26.8958L17.3361 27.6456C17.3517 27.6318 17.3668 27.6176 17.3815 27.6029L16.6744 26.8958ZM2.60754 16.6875L3.31464 15.9804L3.29262 15.9584L3.26927 15.9378L2.60754 16.6875ZM7.45345 6.20833C6.90117 6.20833 6.45345 6.65605 6.45345 7.20833C6.45345 7.76062 6.90117 8.20833 7.45345 8.20833V6.20833ZM7.46803 8.20833C8.02032 8.20833 8.46803 7.76062 8.46803 7.20833C8.46803 6.65605 8.02032 6.20833 7.46803 6.20833V8.20833ZM2.62012 7.20833C2.62012 4.53896 4.78407 2.375 7.45345 2.375V0.375C3.6795 0.375 0.620117 3.43439 0.620117 7.20833H2.62012ZM2.62012 14.5V7.20833H0.620117V14.5H2.62012ZM7.45345 2.375H14.7451V0.375H7.45345V2.375ZM14.7451 2.375C15.3174 2.375 15.8302 2.62459 16.1829 3.02415L17.6824 1.70069C16.9661 0.889224 15.9151 0.375 14.7451 0.375V2.375ZM26.8701 14.5C26.8701 15.0723 26.6205 15.5851 26.221 15.9378L27.5444 17.4372C28.3559 16.721 28.8701 15.6699 28.8701 14.5H26.8701ZM26.3912 13.2325C26.69 13.571 26.8701 14.0132 26.8701 14.5H28.8701C28.8701 13.5074 28.4996 12.5989 27.8907 11.909L26.3912 13.2325ZM14.7451 26.625C14.2583 26.625 13.8161 26.4448 13.4776 26.1461L12.1541 27.6456C12.844 28.2544 13.7525 28.625 14.7451 28.625V26.625ZM16.0126 26.1461C15.6741 26.4448 15.2319 26.625 14.7451 26.625V28.625C15.7377 28.625 16.6463 28.2544 17.3361 27.6456L16.0126 26.1461ZM3.26927 15.9378C2.8697 15.5851 2.62012 15.0723 2.62012 14.5H0.620117C0.620117 15.6699 1.13434 16.721 1.9458 17.4372L3.26927 15.9378ZM16.2255 3.06953L26.4338 13.2779L27.8481 11.8636L17.6397 1.65531L16.2255 3.06953ZM13.523 26.1887L3.31464 15.9804L1.90043 17.3946L12.1088 27.6029L13.523 26.1887ZM26.1756 15.9804L15.9673 26.1887L17.3815 27.6029L27.5898 17.3946L26.1756 15.9804ZM7.45345 8.20833H7.46803V6.20833H7.45345V8.20833Z" fill="#E7EFF6"/>
            </svg>
            <h3 class="tw-font-bold tw-text-xl">Two payments on us</h3>
        </div>
        {{-- Card Body --}}
        <div class="tw-p-6 tw-flex tw-flex-col">
            <div>
                <p class="tw-mb-4 tw-font-semibold">Take a break from payments and save ${{ $amountSaved }} PLUS keep access to
                    all your lessons</p>

                <p class="tw-font-semibold">Regular:</p>
                <p style="text-decoration-line: line-through;" class="tw-font-semibold">${{ $subscriptionPrice }}/mo</p>
                
                <p class="tw-text-red-500 tw-font-bold tw-text-2xl tw-mb-3">$0.00/mo</p>
                
                <div class="tw-text-center tw-mb-6">
                    <p class="tw-text-sm tw-font-semibold">No payment for two months.</p>
                    <p class="tw-text-sm tw-font-semibold">Next payment will be on {{ $nextPaymentDateWithOffer->format('F j, Y') }}.</p>
                </div>
            </div>
            <form method="post"
                action="{{ url()->route('platform.profile.settings.gratis-access') }}"
                id="cancel-reason-form"
                class="tw-flex tw-flex-col tw-flex-grow">
                {{ csrf_field() }}
                <button
                    type="submit"
                    class="tw-btn-primary tw-bg-white tw-text-[#000C17] tw-mx-auto tw-px-8"
                    style="cursor: pointer">
                    Continue My Membership
                </button>
            </form>
        </div>
    </div>

    {{-- Card Two --}}
    <div class="tw-border tw-border-[#445F74] tw-rounded-md">
        {{-- Card Header --}}
        <div class="tw-bg-[#102230] tw-p-6 tw-flex tw-flex-col tw-items-center">
            <svg width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg" class="tw-mb-2">
                <path d="M10.6299 24.7083V15.9583C10.6299 14.3475 9.32405 13.0417 7.71322 13.0417H4.79655C3.18572 13.0417 1.87988 14.3475 1.87988 15.9583V24.7083C1.87988 26.3192 3.18572 27.625 4.79655 27.625H7.71322C9.32405 27.625 10.6299 26.3192 10.6299 24.7083ZM10.6299 24.7083V10.125C10.6299 8.51417 11.9357 7.20833 13.5465 7.20833H16.4632C18.074 7.20833 19.3799 8.51417 19.3799 10.125V24.7083M10.6299 24.7083C10.6299 26.3192 11.9357 27.625 13.5465 27.625H16.4632C18.074 27.625 19.3799 26.3192 19.3799 24.7083M19.3799 24.7083V4.29167C19.3799 2.68084 20.6857 1.375 22.2966 1.375H25.2132C26.824 1.375 28.1299 2.68084 28.1299 4.29167V24.7083C28.1299 26.3192 26.824 27.625 25.2132 27.625H22.2966C20.6857 27.625 19.3799 26.3192 19.3799 24.7083Z" stroke="#E7EFF6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h3 class="tw-font-bold tw-text-xl">A personalized learning plan</h3>
        </div>
        {{-- Card Body --}}
        <div class="tw-p-6 tw-flex tw-flex-col">
            <div class="tw-mb-5">
                <p class="tw-mb-4 tw-font-semibold">We don't want to see you go - and sometimes all you need is a nudge in the right direction.</p>
                <p class="tw-mb-4 tw-font-semibold">By clicking below, you'll be connected directly with one of our instructors and receive a
                    personalized learning plan, just for you.</p>
            </div>
            <form method="post"
                action="{{ url()->route('platform.profile.settings.student-plan-offer') }}"
                id="cancel-reason-form"
                class="tw-flex tw-flex-col tw-flex-grow">
                {{ csrf_field() }}
                <button
                    type="submit"
                    class="tw-btn-primary tw-bg-white tw-text-[#000C17] tw-mx-auto tw-px-8"
                    style="cursor: pointer">
                    Get My Personalized Plan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
