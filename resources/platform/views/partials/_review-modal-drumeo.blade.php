<div id="applicationModal" class="modal">
    <div class="tw-text-black tw-flex tw-flex-col tw-bg-white tw-rounded-[10px] tw-shadow tw-p-[30px]">

        <div class="tw-flex tw-flex-row tw-mb-[30px]">
            <h1 class="subheading">Student Review Application</h1>
        </div>

        <form id="studentFocusForm"
              method="POST"
              action="{{url()->route('platform.mail')}}"
              accept-charset="UTF-8">
            {{ csrf_field() }}

            <input type="hidden" name="type" value="student-focus-application-drumeo">
            <?php $user = auth()->user(); /** @var Railroad\Usora\Entities\User $user */ ?>
            <input type="hidden" name="success-message" value="Your email has been sent. We'll be in touch very soon!">
            <input type="hidden" name="brand" value="{{ $brand }}">
            <input type="hidden" name="subject" value="Student Focus Application from {{ user()->display_name }} ({{ user()->email }})">

            <div class="flex flex-column mb-2">
                <p class="body">What is your current drumming skill level?</p>

                @include('partials.bladesora.members.inputs.select-input', [
                    "brand" => 'drumeo',
                    "inputId" => "applicationSkill",
                    "inputName" => "experience",
                    "customClasses" => 'no-label',
                    "inputValue" => old('experience'),
                    "inputErrors" => $errors->get('experience') ?? null,
                    "inputOptions" => ['beginner', 'intermediate', 'advanced'],
                    "inputLabel" => null
                ])
            </div>

            <div class="flex flex-column mb-2">
                <p class="body">What is one aspect of your drumming you'd like to improve on?</p>
                @include('partials.bladesora.members.inputs.text-input', [
                    "brand" => 'drumeo',
                    "inputId" => "applicationImproval",
                    "inputName" => "improvement",
                    "customClasses" => 'no-label',
                    "inputValue" => old('improvement'),
                    "inputErrors" => $errors->get('improvement') ?? null,
                    "type" => "text",
                    "inputLabel" => null
                ])
            </div>

            <div class="flex flex-column mb-2">
                <p class="body">What is your biggest weakness as a drummer?</p>
                @include('partials.bladesora.members.inputs.text-input', [
                    "brand" => 'drumeo',
                    "inputId" => "applicationWeakness",
                    "inputName" => "weakness",
                    "customClasses" => 'no-label',
                    "inputValue" => old('weakness'),
                    "inputErrors" => $errors->get('weakness') ?? null,
                    "type" => "text",
                    "inputLabel" => null
                ])
            </div>

            <div class="flex flex-column mb-2">
                <p class="body">What would you like the instructor to focus on?</p>
                @include('partials.bladesora.members.inputs.text-input', [
                    "brand" => 'drumeo',
                    "inputId" => "applicationFocus",
                    "inputName" => "instructor_focus",
                    "customClasses" => 'no-label',
                    "inputValue" => old('instructor_focus'),
                    "inputErrors" => $errors->get('instructor_focus') ?? null,
                    "type" => "text",
                    "inputLabel" => null
                ])
            </div>

            <div class="flex flex-column mb-2">
                <p class="body">What is your goal as a drummer?</p>

                @include('partials.bladesora.members.inputs.select-input', [
                    "brand" => 'drumeo',
                    "inputId" => "applicationSkill",
                    "inputName" => "goal",
                    "customClasses" => 'no-label',
                    "inputValue" => old('goal'),
                    "inputErrors" => $errors->get('goal') ?? null,
                    "inputOptions" => ['fun/hobbyist', 'cover band', 'professional'],
                    "inputLabel" => null
                ])
            </div>

            <div class="flex flex-column mb-2">
                <p class="body">Youtube Video URL</p>
                @include('partials.bladesora.members.inputs.text-input', [
                    "brand" => 'drumeo',
                    "inputId" => "applicationFocus",
                    "inputName" => "youtube_url",
                    "customClasses" => 'no-label',
                    "inputValue" => old('youtube_url'),
                    "inputErrors" => $errors->get('youtube_url') ?? null,
                    "type" => "text",
                    "inputLabel" => null
                ])
            </div>
            <div class="tw-flex tw-flex-row tw-w-full tw-justify-end">
                <button class="close-modal tw-btn-secondary tw-min-h-[30px] tw-w-[118px] tw-text-[#A1A1A9] tw-border-[#A1A1A9] tw-mr-[12px] tw-text-[16px]"
                        type="reset">
                    Cancel
                </button>

                <button class="tw-btn-primary tw-bg-drumeo tw-min-h-[30px] tw-w-[118px] tw-text-white tw-text-center tw-text-[16px]"
                        type="submit">
                    Apply
                </button>
            </div>
        </form>
    </div>
</div>
