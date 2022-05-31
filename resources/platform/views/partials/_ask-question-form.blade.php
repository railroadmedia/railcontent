<div class="tw-flex tw-flex-row">
    <div class="tw-flex tw-flex-col tw-mr-4 tw-py-1">
        <button class="tw-btn tw-btn-primary tw-bg-{{ $brand }} tw-h-[50px] tw-w-full lg:tw-w-[345px] 3xl:tw-w-[465px]"
            data-open-modal="askQuestionModal">
            Ask a Question
        </button>
    </div>
</div>

<div class="modal" id="askQuestionModal">
    <div class="flex flex-column bg-white shadow corners-10 pa-3">
        <h1 class="heading mb-2 tw-text-black">Ask a Question</h1>

        <p class="tiny mb-3 tw-text-black">Please submit your question(s) using the form below. Once submitted your question(s) will be answered in the next scheduled Q&A lesson.</p>

        <email-form
                email-subject="Question Asked by: {{ user()->display_name }} ({{ user()->email }})"
                brand="{{ $brand }}"
                recipient="{{ config('mail-recipients.ask-question-form') ?? 'support@singeo.com' }}"
                input-label="Ask your question here..."
                email-type="layouts/inline/alert"
                email-endpoint="/mailora/secure/send"
                email-logo="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png"
                email-alert="Question Asked by: {{ user()->display_name }} ({{ user()->email }})"
                theme-color="{{ $brand }}"
                success-message="Question successfully sent!"
                :lesson-page="false"></email-form>
    </div>
</div>
