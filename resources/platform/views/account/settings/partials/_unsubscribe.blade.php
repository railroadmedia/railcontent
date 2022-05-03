<div id="membershipUnsubscribe" class="tw-flex tw-flex-col hide">
    <div class="tw-flex tw-flex-row pa-3 bb-grey-1-1 tw-flex-auto">
        <h1 class="heading">Unsubscribe</h1>
    </div>
    <div class="tw-flex tw-flex-row pa-3 bb-grey-1-1">
        <div class="tw-flex tw-flex-col">
            <h6 class="title tw-mb-2">Hey {{ current_user()->getDisplayName() }}!</h6>

            <p class="tiny tw-uppercase text-error tw-font-bold">Please Read</p>
            <p class="body tw-mb-2">When you first signed up for Musora, you made a decision to learn to sing or improve your skills. You were probably excited to get started and had this amazing sense of motivation and inspiration. Take a moment to reflect on what's happened since then...</p>

            <p class="body tw-mb-2">Are you practicing less? Do you feel like you've hit a wall and aren't getting any better? Are you lost on what to learn next?</p>

            <p class="body tw-mb-2">Myself and the entire Musora Team are committed to helping you get better, whatever it takes. Before you unsubscribe, I'd encourage you to fill out the form below and someone from our team will contact you personally to make sure that you're setup with the tools you need to succeed.</p>

            <p class="body tw-mb-2">My advice: Don't give up.</p>

            <p class="body tw-mb-2">The biggest difference between successful and unsuccessful singers is the quality and quantity of action they take. Make a decision right now to get better and fill out the form below (you can do this!). We're looking forward to talking more with you about how we can help you achieve your goals. </p>

            <p class="body tw-mb-2">To your success,</p>

            <p class="body tw-mb-2">~ Lisa Witt</p>
        </div>
    </div>
    <div class="tw-flex tw-flex-row pa-3">
        <form action="{{ url()->route('members.profile.unsubscribe') }}" method="POST">
            {{ csrf_field() }}
            <p class="body tw-font-bold tw-mb-2">1) What would you like to do? Please choose an option below.</p>

            <div class="tw-mb-2">
                @include('partials.bladesora.members.inputs.radio-input', [
                    "inputID" => "instructorPlease",
                    "inputName" => "action",
                    "inputLabel" => "I'd like to be contacted by a Musora Instructor to discuss how Musora can help me achieve my goals.",
                    "inputValue" => 'instructor',
                    "checked" => true
                ])
            </div>

            @if(!empty($subscription->getPaidUntil()))
                <div class="mb-3">
                    @include('partials.bladesora.members.inputs.radio-input', [
                        "inputID" => "contactMe",
                        "inputName" => "action",
                        "inputLabel" => "I'd like to unsubscribe.<br><span class='tiny font-italic text-grey-3'>Your account will expire on: " . Carbon\Carbon::parse($subscription->getPaidUntil())->format('F jS, Y') . ". Automatic renewal payments will stop immediately.</span>",
                        "inputValue" => 'cancel',
                        "checked" => false
                    ])
                </div>
            @else
                <div class="mb-3">
                    @include('partials.bladesora.members.inputs.radio-input', [
                        "inputID" => "contactMe",
                        "inputName" => "action",
                        "inputLabel" => "I'd like to unsubscribe.<br><span class='tiny font-italic text-grey-3'>Please allow 48 hours for your cancellation to be processed.</span>",
                        "inputValue" => 'cancel',
                        "checked" => false
                    ])
                </div>
            @endif

            <p class="body tw-font-bold tw-mb-2">2) Why do you want to unsubscribe? Please choose one reason below.</p>

            <div class="tw-mb-2">
                @include('partials.bladesora.members.inputs.radio-input', [
                    "inputID" => "noTime",
                    "inputName" => "reason",
                    "inputLabel" => "I don't have the time.",
                    "inputValue" => "I don't have the time.",
                    "checked" => true
                ])
            </div>

            <div class="tw-mb-2">
                @include('partials.bladesora.members.inputs.radio-input', [
                    "inputID" => "notUsing",
                    "inputName" => "reason",
                    "inputLabel" => "I'm not using it.",
                    "inputValue" => "I'm not using it.",
                    "checked" => false
                ])
            </div>

            <div class="tw-mb-2">
                @include('partials.bladesora.members.inputs.radio-input', [
                    "inputID" => "tooEasy",
                    "inputName" => "reason",
                    "inputLabel" => "The lessons are too easy.",
                    "inputValue" => "The lessons are too easy.",
                    "checked" => false
                ])
            </div>

            <div class="tw-mb-2">
                @include('partials.bladesora.members.inputs.radio-input', [
                    "inputID" => "tooDifficult",
                    "inputName" => "reason",
                    "inputLabel" => "The lessons are too difficult.",
                    "inputValue" => "The lessons are too difficult.",
                    "checked" => false
                ])
            </div>

            <div class="tw-mb-2">
                @include('partials.bladesora.members.inputs.radio-input', [
                    "inputID" => "tooExpensive",
                    "inputName" => "reason",
                    "inputLabel" => "It's too expensive.",
                    "inputValue" => "It's too expensive.",
                    "checked" => false
                ])
            </div>

            <div class="tw-mb-2">
                @include('partials.bladesora.members.inputs.radio-input', [
                    "inputID" => "dontKnow",
                    "inputName" => "reason",
                    "inputLabel" => "I don't know how to use it.",
                    "inputValue" => "I don't know how to use it.",
                    "checked" => false
                ])
            </div>

            <div class="tw-mb-2">
                @include('partials.bladesora.members.inputs.radio-input', [
                    "inputID" => "other",
                    "inputName" => "reason",
                    "inputLabel" => "Other",
                    "inputValue" => "Other",
                    "checked" => false
                ])
            </div>

            <div id="reasonInput" class="tw-mb-2 hide">
                @include('partials.bladesora.members.inputs.textarea-input', [
                   "brand" => "Musora",
                   "type" => "text",
                   "inputId" => "otherReason",
                   "inputName" => "other-reason",
                   "inputLabel" => "Reason",
                   "inputValue" => "",
                   "inputErrors" => []
                ])
            </div>

            <div class="tw-flex tw-flex-row">
                <button type="submit" class="btn collapse-150">
                    <span class="short tw-bg-{{ $brand }} tw-text-white">
                        Submit
                    </span>
                </button>

                <button id="cancelUnsubscribeForm" type="reset" class="btn collapse-150">
                    <span class="short flat tw-text-black">
                        Cancel
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>