@if(!empty(user()))
    <div
        class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-relative tw-mt-2"
        style="z-index:2;"
    >
        <div class="tw-rounded-md tw-w-full bg-grey-2 dark:tw-bg-[#002039] tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-flex tw-justify-center tw-py-4">
            <div class="tw-flex tw-flex-row tw-justify-center tw-flex-wrap tw-w-full nmh-1">
                <div class="flex flex-column xs-12 sm-6 md-5 pa-1">
                    <div class="flex flex-row">
                        <div class="flex flex-column avatar-col">
                            <div class="square">
                                <img
                                    src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/lisa-witt.jpg"
                                    data-ix-src="https://d2vyvo0tyx8ig5.cloudfront.net/books/foundations/lisa-witt.jpg"
                                    data-ix-fade
                                    class="rounded"
                                    alt="Pianote Lisa Headshot"
                                >
                            </div>
                        </div>
                        <div class="flex flex-column pl-2 tw-justify-center">
                            <p class="body dark:tw-text-white">
                                <strong>Have a Question?</strong>
                                Ask ANY question and get answers from REAL teachers
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-column xs-12 sm-6 md-3 pa-1">
                    <button
                        class="btn"
                        data-open-modal="askQuestionModal"
                    >
                        <span class="bg-pianote text-white">
                            <i class="fas fa-comment mr-1"></i>
                            Ask a Question
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@if(!empty(session('emailSuccess')))
    <div
        id="questionSuccess"
        class="container mt-2 relative"
        style="z-index:1;"
    >
        <div class="flex flex-row corners-3 pa-2 bg-pianote align-center">
            <p class="body text-white text-center">
                <i class="fas fa-check mr-1"></i>
                Your question has successfully been sent!
            </p>
        </div>
    </div>
@endif

<div id="askQuestionModal" class="modal">
    <div class="flex flex-column bg-white shadow corners-3 pa-2">
        <h1 class="heading mb-2">Ask a Question</h1>
        @if(!empty(user()))
            <email-form
                email-subject="Question Asked by: {{ user()->display_name }} ({{ user()->email }})"
                brand="pianote"
                recipient="{{ config('mail-recipients.ask-question-form') ?? 'brett@musora.com' }}"
                input-label="Ask your question here..."
                email-type="layouts/inline/alert"
                email-endpoint="/mailora/secure/send"
                email-logo="https://dmmior4id2ysr.cloudfront.net/logos/pianote-logo-red.png"
                email-alert="Question Asked by: {{ user()->display_name }} ({{ user()->email }})"
                theme-color="pianote"
                success-message="Question successfully sent!"
                :lesson-page="false">
            </email-form>
        @endif
    </div>
</div>
