<div class="tw-flex tw-flex-col lg:tw-flex-row tw-flex-wrap tw-mt-2">
    <div class="tw-flex tw-flex-col tw-mr-4 tw-py-1">
        <button class="tw-btn tw-btn-primary tw-bg-singeo tw-h-[50px] tw-w-full lg:tw-w-[345px] 3xl:tw-w-[465px]"
                data-open-modal="whatIsModal">
            <span class="tw-text-white">
                What is Student Review?
            </span>
        </button>
    </div>
    <div class="tw-flex tw-flex-col tw-mr-4 tw-py-1">
        <button class="tw-btn tw-btn-primary tw-bg-singeo tw-h-[50px] tw-w-full lg:tw-w-[345px] 3xl:tw-w-[465px]"
                data-open-modal="howApplyModal">
            <span class="tw-text-white">
                How to Apply
            </span>
        </button>
    </div>
    <div class="tw-flex tw-flex-col tw-mr-4 tw-py-1">
        <button class="tw-btn tw-btn-primary tw-bg-singeo tw-h-[50px] tw-w-full lg:tw-w-[345px] 3xl:tw-w-[465px]"
                data-open-modal="applicationModal">
            <span class="tw-text-white">
                Apply Now
            </span>
        </button>
    </div>
</div>


<div id="applicationModal" class="modal">
    <div class="tw-text-black tw-flex tw-flex-col tw-bg-white tw-rounded-[10px] tw-shadow tw-p-[30px]">

        <div class="tw-flex tw-flex-row tw-mb-[30px]">
            <h1 class="subheading">Student Review Application</h1>
        </div>

        <form id="studentReviewForm"
              method="POST"
              action=""
              accept-charset="UTF-8">

            <input type="hidden" name="subject" value="Student Review Application from: {{ user()->display_name }} ({{ user()->email }})">

            <input type="hidden" name="student progress info" value="https://{{ current_subdomain() }}musora.com/admin/user-progress-info/{{ user()->id }}">
            <div class="flex flex-column mb-2">
                <p class="body">What is your goal as a singer?</p>

                @include('partials.bladesora.members.inputs.text-input', [
                    "brand" => $brand,
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
                    "brand" => $brand,
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
                <p class="body">What is your biggest weakness as a singer?</p>
                @include('partials.bladesora.members.inputs.text-input', [
                    "brand" => $brand,
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
                <p class="body">Tell us about your submission. What are you singing and what would you like the instructor to focus on?</p>
                @include('partials.bladesora.members.inputs.textarea-input', [
                    "brand" => $brand,
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
                    "brand" => $brand,
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

            <div class="tw-flex tw-flex-row tw-w-full tw-justify-end">
                <button class="close-modal tw-btn tw-btn-secondary tw-min-h-[30px] tw-w-[118px] tw-text-[#A1A1A9] tw-border-[#A1A1A9] tw-mr-[12px] tw-text-[16px] tw-font-bold"
                        type="reset">
                    Cancel
                </button>

                <button class="tw-btn tw-btn-primary tw-bg-singeo tw-min-h-[30px] tw-w-[118px] tw-text-white tw-text-center tw-text-[16px] tw-font-bold"
                type="submit">
                    Apply
                </button>
            </div>
        </form>
    </div>
</div>
