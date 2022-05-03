<div class="flex flex-row mt-3">
    <div class="flex flex-column">
        <h1 class="title text-white mb-2">
            Have an idea for a Learning Path?
        </h1>
        <button class="btn collapse-250 short"
                data-open-modal="suggestLearningPath">
                <span class="bg-{{ $brand }} text-white">
                    Suggest a Learning Path
                </span>
        </button>
    </div>
</div>

<div class="modal" id="suggestLearningPath">
    <div class="flex flex-column bg-white shadow corners-10 pa-3">
        <h1 class="heading mb-3">Suggest a Learning Path</h1>

        <email-form
                email-subject="Learning Path Suggestion from: {{ current_user()->getDisplayName() }} ({{ current_user()->getEmail() }})"
                brand="{{ $brand }}"
                recipient="lisa@singeo.com"
                input-label="Type your suggestion here..."
                email-type="layouts/inline/alert"
                email-endpoint="/mailora/secure/send"
                email-logo="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png"
                email-alert="Learning Path Suggestion from: {{ current_user()->getDisplayName() }} ({{ current_user()->getEmail() }})"
                theme-color="{{ $brand }}"
                success-message="Suggestion successfully sent!"
                :lesson-page="false"></email-form>
    </div>
</div>