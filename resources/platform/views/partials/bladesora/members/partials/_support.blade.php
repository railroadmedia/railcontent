<div class="tw-flex tw-flex-col tw-max-w-3xl tw-mx-auto tw-px-4">
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
</div>
