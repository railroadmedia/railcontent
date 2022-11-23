<div class="tw-flex tw-flex-col tw-max-w-3xl tw-mx-auto tw-px-4">

    <section>
        <div class="md:tw-mt-12 tw-text-center tw-text-[#00101D] dark:tw-text-white">
            <h2 class="tw-font-bold tw-text-3xl tw-mb-6">We'd love to hear from you!</h2>
            <p class="tw-mb-6 tw-text-base">Whether your question is about membership, shipping, technical troubles or anything else, our amazing support team is ready to answer any and all of your questions!</p>
            <p class="tw-text-base">You may find your response in our <a href="https://help.{{ $brand }}.com/" class="tw-font-bold tw-no-underline tw-text-{{ $brand }}" title="go to help center">Help Center here</a>, but if not, fill out the quick form below.</p>
        </div>
    </section>

    <section class="tw-flex tw-flex-row tw-flex-wrap mv-3 tw-w-full">
        <div class="tw-flex tw-flex-col tw-w-full">
            <contact-member-email-form
                brand="{{ $brand }}"
                email-subject="{{ $emailSubject }}"
                email-type="{{ $emailType }}"
                email-endpoint="{{ $emailEndpoint }}"
                email-logo="{{ $emailLogo }}"
                email-alert="{{ $emailSubject }}"
                input-label="{{ $emailInputLabel }}"
                :lesson-page="false"
                recipient="{{ $emailRecipient ?? 'support@' . $brand . '.com' }}"
                success-message="{{ $emailSuccessMessage }}"
            />
        </div>
    </section>

    <section class="tw-flex tw-flex-col tw-text-center tw-mb-8 tw-text-[#00101D] dark:tw-text-white">
        <h2 class="tw-font-bold tw-text-3xl">Old fashioned phone calls work too!</h2>
        <div class="tw-flex tw-my-8 tw-flex-col tw-items-center sm:tw-flex-row">
            <div class="tw-flex tw-flex-col tw-w-10/12 sm:tw-w-1/3 tw-font-bold tw-justify-center tw-p-3 tw-border-solid tw-border-0 tw-border-b-2 sm:tw-border-b-0 sm:tw-border-r-2 tw-border-gray-300 dark:tw-border-[#223F57]">
                <h4 class="tw-font-bold tw-mb-1">Toll-Free</h4>
                <a href="tel:{{ $tollFree }}" class=" tw-text-{{ $brand }} sm:mb-2 no-decoration tw-text-base">{{ $tollFree }}</a>
            </div>
            <div class="tw-flex tw-flex-col tw-w-10/12 sm:tw-w-1/3 tw-font-bold tw-justify-center tw-p-3 tw-border-solid tw-border-0 tw-border-b-2 sm:tw-border-b-0 sm:tw-border-r-2 tw-border-gray-300 dark:tw-border-[#223F57]">
                <h4 class="tw-font-bold tw-mb-1">Direct/International</h4>
                <a href="tel:{{ $internationalNumber }}" class=" tw-text-{{ $brand }} sm:mb-2 no-decoration tw-text-base">{{ $internationalNumber }}</a>
            </div>
            <div class="tw-flex tw-flex-col tw-w-10/12 sm:tw-w-1/3 tw-font-bold tw-justify-center tw-p-3">
                <h4 class="tw-font-bold tw-mb-1">Office Hours</h4>
                <p class="text-{{ $brand }} tw-text-base"> Monday-Friday</p>
                <p class="text-{{ $brand }} sm:mb-2 tw-text-base">8 AM - 4 PM Pacific Time</p>
            </div>
        </div>
    </section>

    <section class="tw-flex tw-flex-col tw-text-center tw-mb-12 tw-text-[#00101D] dark:tw-text-white">
        <h2 class="tw-font-bold tw-text-3xl tw-mb-3 md:tw-mb-6">Want to join the team?</h2>
        <p class="tw-text-base">For current available positions at our company, please visit <a href="/careers" title="go to help center" class="tw-font-bold tw-no-underline tw-text-{{ $brand }}">Musora.com/Careers</a>.</p>
    </section>
</div>
