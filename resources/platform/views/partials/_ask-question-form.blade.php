<div class="flex flex-row">
    <div class="flex flex-column">
        <button class="btn collapse-250 short"
                data-open-modal="askQuestionModal">
                <span class="bg-singeo text-white">
                    Ask a Question
                </span>
        </button>
    </div>
</div>

<div class="modal" id="askQuestionModal">
    <div class="flex flex-column bg-white shadow corners-10 pa-3">
        <h1 class="heading mb-2">Ask a Question</h1>

        <p class="tiny mb-3">Please submit your question(s) using the form below. Once submitted your question(s) will be answered in the next scheduled Q&A lesson.</p>

        <email-form
                email-subject="Question Asked by: {{ current_user()->getDisplayName() }} ({{ current_user()->getEmail() }})"
                brand="singeo"
                recipient="{{ config('mail-recipients.ask-question-form') ?? 'support@singeo.com' }}"
                input-label="Ask your question here..."
                email-type="layouts/inline/alert"
                email-endpoint="/mailora/secure/send"
                email-logo="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png"
                email-alert="Question Asked by: {{ current_user()->getDisplayName() }} ({{ current_user()->getEmail() }})"
                theme-color="singeo"
                success-message="Question successfully sent!"
                :lesson-page="false"></email-form>
    </div>
</div>