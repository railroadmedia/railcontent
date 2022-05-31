<div class="tw-flex tw-flex-col lg:tw-flex-row tw-flex-wrap tw-mt-2">
    <div class="tw-flex tw-flex-col tw-mr-4 tw-py-1">
        <button class="tw-btn tw-btn-primary tw-bg-drumeo tw-h-[50px] tw-w-full lg:tw-w-[345px] 3xl:tw-w-[465px]"
                data-open-modal="whatIsModal">
            <span class="tw-text-white">
                What is Student Review?
            </span>
        </button>
    </div>
    <div class="tw-flex tw-flex-col tw-mr-4 tw-py-1">
        <button class="tw-btn tw-btn-primary tw-bg-drumeo tw-h-[50px] tw-w-full lg:tw-w-[345px] 3xl:tw-w-[465px]"
                data-open-modal="howApplyModal">
            <span class="tw-text-white">
                How to Apply
            </span>
        </button>
    </div>
    <div class="tw-flex tw-flex-col tw-mr-4 tw-py-1">
        <button class="tw-btn tw-btn-primary tw-bg-drumeo tw-h-[50px] tw-w-full lg:tw-w-[345px] 3xl:tw-w-[465px]"
                data-open-modal="applicationModal">
            <span class="tw-text-white">
                Apply Now
            </span>
        </button>
    </div>
</div>

<div id="whatIsModal" class="modal">
    <div class="flex flex-column corners-10">
        <div class="video-wrap">
            <div class="widescreen">
                <div class="flex flex-column video-player user-active">
                    <iframe style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;" src="//player.vimeo.com/video/450154189" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="howApplyModal" class="modal">
    <div class="twflex tw-flex-col tw-rounded-[10px]">
        <div class="video-wrap">
            <div class="widescreen">
                <div class="flex flex-column video-player user-active">
                    <iframe style="max-width: 100%; width: 100%; height: 100%; position: absolute; top: 0; left: 0;z-index: 1;" src="//player.vimeo.com/video/450152568" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="applicationModal" class="modal">
    <div class="tw-text-black tw-flex tw-flex-col tw-bg-white tw-rounded-[10px] tw-shadow tw-p-[30px]">

        <div class="tw-flex tw-flex-row tw-mb-[30px]">
            <h1 class="subheading">Student Review Application</h1>
        </div>

        <form id="studentFocusForm"
              method="POST"
              action=""
              accept-charset="UTF-8">

            <input type="hidden" name="type" value="student-focus-application">
            <?php $user = auth()->user(); /** @var Railroad\Usora\Entities\User $user */ ?>
            <input type="hidden" name="subject" value="Student Focus Application from {{ user()->email }}">
            <input type="hidden" name="success-message" value="Your email has been sent. We'll be in touch very soon!">

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
                <button class="close-modal tw-btn tw-btn-secondary tw-min-h-[30px] tw-w-[118px] tw-text-[#A1A1A9] tw-border-[#A1A1A9] tw-mr-[12px] tw-text-[16px] tw-font-bold"
                        type="reset">
                    Cancel
                </button>

                <button class="tw-btn tw-btn-primary tw-bg-drumeo tw-min-h-[30px] tw-w-[118px] tw-text-white tw-text-center tw-text-[16px] tw-font-bold"
                type="submit">
                    Apply
                </button>
            </div>
        </form>
    </div>
</div>
