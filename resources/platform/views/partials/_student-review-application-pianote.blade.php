<div class="flex flex-row align-left">
    <button class="btn collapse-200"
            data-open-modal="applicationModal">
        <span class="bg-pianote text-white short">
            Apply
        </span>
    </button>
</div>


<div id="applicationModal" class="modal">
    <div class="flex flex-column bg-white corners-10 shadow pa-3">

        <div class="flex flex-row mb-3">
            <h1 class="subheading">Student Review Application</h1>
        </div>

        <form id="studentReviewForm"
              method="POST"
              action=""
              accept-charset="UTF-8">

            <input type="hidden" name="subject" value="Student Review Application from: ({{ user()->email }})">

            <input type="hidden" name="student progress info" value="https://{{ current_subdomain() }}musora.com/admin/user-progress-info/{{ user()->id }}">
            <div class="flex flex-column mb-2">
                <p class="body">What is your goal as a Piano player?</p>

                @include('partials.bladesora.members.inputs.text-input', [
                    "brand" => 'pianote',
                    "inputId" => "pianoGoal",
                    "inputLabel" => "",
                    "inputName" => "goal",
                    "customClasses" => 'no-label',
                    "inputValue" => old('goal'),
                    "inputErrors" => $errors->get('goal') ?? null,
                    "type" => "text",
                    "validateRequired" => true,
                ])
            </div>

            <div class="flex flex-column mb-2">
                <p class="body">What is one skill you'd like to improve on?</p>
                @include('partials.bladesora.members.inputs.text-input', [
                    "brand" => 'pianote',
                    "inputId" => "skillImproval",
                    "inputLabel" => "",
                    "inputName" => "improvement",
                    "customClasses" => 'no-label',
                    "inputValue" => old('improvement'),
                    "inputErrors" => $errors->get('improvement') ?? null,
                    "type" => "text",
                    "validateRequired" => true,
                ])
            </div>

            <div class="flex flex-column mb-2">
                <p class="body">What is your biggest weakness as a piano player?</p>
                @include('partials.bladesora.members.inputs.text-input', [
                    "brand" => 'pianote',
                    "inputId" => "pianoWeakness",
                    "inputLabel" => "",
                    "inputName" => "weakness",
                    "customClasses" => 'no-label',
                    "inputValue" => old('weakness'),
                    "inputErrors" => $errors->get('weakness') ?? null,
                    "type" => "text",
                    "validateRequired" => true,
                ])
            </div>

            <div class="flex flex-column mb-2">
                <p class="body">Tell us about your submission. What are you playing and what would you like the instructor to focus on?</p>
                @include('partials.bladesora.members.inputs.textarea-input', [
                    "brand" => 'pianote',
                    "inputId" => "applicationFocus",
                    "inputLabel" => "",
                    "inputName" => "instructor_focus",
                    "customClasses" => 'no-label',
                    "inputValue" => old('instructor_focus'),
                    "inputErrors" => $errors->get('instructor_focus') ?? null,
                    "type" => "text",
                    "validateRequired" => true,
                ])
            </div>

            <div class="flex flex-column mb-2">
                <p class="body">Youtube Video URL</p>
                @include('partials.bladesora.members.inputs.text-input', [
                    "brand" => 'pianote',
                    "inputId" => "applicationFocus",
                    "inputLabel" => "",
                    "inputName" => "youtube_url",
                    "customClasses" => 'no-label',
                    "inputValue" => old('youtube_url'),
                    "inputErrors" => $errors->get('youtube_url') ?? null,
                    "type" => "text",
                    "validateRequired" => true,
                ])
            </div>

            <div class="flex flex-row align-h-right">
                <button class="btn collapse-150 mr-1 close-modal"
                        type="reset">
                    <span class="bg-grey-2 text-grey-3 flat short">
                        Cancel
                    </span>
                </button>

                <button class="btn collapse-150"
                        type="submit">
                    <span class="bg-pianote text-white short">
                        Apply
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
