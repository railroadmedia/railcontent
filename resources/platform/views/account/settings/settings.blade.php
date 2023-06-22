@extends('account.settings.layout')

@section('meta')
    <title>Notification Settings | Musora</title>
@endsection

@section('edit-forms')
    <div class="tw-flex tw-flex-row tw-px-3 tw-pt-6 tw-pb-0 tw-flex-auto">
        <h1 class="tw-text-2xl tw-font-bold tw-text-[#00101D] dark:tw-text-white">Notification Settings</h1>
    </div>

    <div class="tw-flex tw-flex-row">
        <div id="editForm" class="tw-flex tw-flex-col tw-w-full">
            <form method="POST" action="/railnotifications/user-notification-settings/update">
                <input type="hidden" name="redirect" value="{{ url()->current().'?selected-brand='.$selectedBrand }}">
                <input type="hidden" name="brand" value="{{ $selectedBrand }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                @include('account.settings.partials._brand-notifications-settings', ['allBrands' => $allBrands])

                <div class="tw-flex tw-flex-row tw-flex-auto tw-mt-3 tw-p-3 tw-text-[#00101D] dark:tw-text-white">
                    <h2 class="tw-font-bold tw-text-lg">
                        What type of notifications would you like to receive from
                        <span class="tw-capitalize">{{ $selectedBrand }}</span>?
                    </h2>
                </div>

                <div class="tw-flex tw-flex-row ph-3 tw-pb-3 tw-mb-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col">
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "sendEmailNotifications",
                                "inputName" => "send_email",
                                "inputLabel" => "Send email notifications.",
                                "checked" => (boolean) ($userNotificationsSettings['send_email'] ?? user()->send_email_notifications)
                            ])
                        </div>

                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "sendMobileAppPushNotifications",
                                "inputName" => "send_in_app_push_notification",
                                "inputLabel" => "Send mobile push notifications.",
                                "checked" => (boolean) ($userNotificationsSettings['send_in_app_push_notification'] ?? user()->send_mobile_app_push_notifications)
                            ])
                        </div>
                    </div>
                </div>

                <div class="tw-flex tw-flex-row tw-flex-auto tw-p-3 tw-text-[#00101D] dark:tw-text-white">
                    <h2 class="tw-font-bold tw-text-lg">When would you like to receive notifications?</h2>
                </div>

                <div class="tw-flex tw-flex-row ph-3 tw-pb-3 tw-mb-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col">
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "weeklyUpdates",
                                "inputName" => "notify_weekly_update",
                                "inputLabel" => "Weekly Community Updates.",
                                "checked" => (boolean) ($userNotificationsSettings['notify_weekly_update'] ?? user()->notify_weekly_update),
                                "disabledOption" => true,
                            ])
                        </div>
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "repliesComment",
                                "inputName" => "notify_on_lesson_comment_reply",
                                "inputLabel" => "When a member replies to my lesson comment.",
                                "checked" => (boolean) ($userNotificationsSettings['notify_on_lesson_comment_reply'] ?? user()->notify_on_lesson_comment_reply),
                                "disabledOption" => true,
                            ])
                        </div>
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "likesComment",
                                "inputName" => "notify_on_lesson_comment_like",
                                "inputLabel" => "When a member likes my lesson comment.",
                                "checked" => (boolean) ($userNotificationsSettings['notify_on_lesson_comment_like'] ?? user()->notify_on_lesson_comment_like),
                                "disabledOption" => true,
                            ])
                        </div>
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "repliesForum",
                                "inputName" => "notify_on_forum_followed_thread_reply",
                                "inputLabel" => "When a member posts in a forum thread I created or follow.",
                                "checked" => (boolean) ($userNotificationsSettings['notify_on_forum_followed_thread_reply'] ?? user()->notify_on_forum_followed_thread_reply),
                                "disabledOption" => true,
                            ])
                        </div>
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "likesForum",
                                "inputName" => "notify_on_forum_post_like",
                                "inputLabel" => "When a member likes my forum posts",
                                "checked" => (boolean) ($userNotificationsSettings['notify_on_forum_post_like'] ?? user()->notify_on_forum_post_like),
                                "disabledOption" => true,
                            ])
                        </div>
                    </div>
                </div>

                <div class="tw-flex tw-flex-row tw-flex-auto tw-text-[#00101D] dark:tw-text-white tw-p-3">
                    <h2 class="tw-font-bold tw-text-lg">How often would you like to receive notifications?</h2>
                </div>

                <div class="tw-flex tw-flex-row ph-3 tw-pb-3 tw-mb-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col">
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.radio-input', [
                                "inputID" => "rightAway",
                                "inputName" => "notifications_summary_frequency_minutes",
                                "inputLabel" => "Send me notifications right away.",
                                "inputValue" => null,
                                "checked" => user()->notifications_summary_frequency_minutes === null
                            ])
                        </div>

                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.radio-input', [
                                "inputID" => "perDay",
                                "inputName" => "notifications_summary_frequency_minutes",
                                "inputLabel" => "Email me a summary of my notifications once per day.",
                                "inputValue" => 1440,
                                "checked" => user()->notifications_summary_frequency_minutes === 1440
                            ])
                        </div>
                    </div>
                </div>

{{--                <div class="tw-flex tw-flex-row tw-flex-auto pa-3 tw-text-[#00101D] dark:tw-text-white tw-py-3">--}}
{{--                    <h2 class="tw-font-bold tw-text-lg">Would you like to use our legacy video player?</h2>--}}
{{--                </div>--}}

{{--                <div class="tw-flex tw-flex-row tw-flex-auto ph-3">--}}
{{--                    <p class="body tw-text-[#00101D] dark:tw-text-white tw-mb-3">--}}
{{--                        Our video player may have compatibility issues with older devices and operating systems.--}}
{{--                        <br>We recommend switching to our legacy video player if you are experiencing playback issues.--}}
{{--                    </p>--}}
{{--                </div>--}}

{{--                <div class="tw-flex tw-flex-row ph-3 tw-pb-3 tw-mb-3 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">--}}
{{--                    <div class="tw-flex tw-flex-col">--}}
{{--                        <div class="tw-flex tw-flex-row tw-mb-2">--}}
{{--                            @include('partials.bladesora.members.inputs.toggle-input', [--}}
{{--                                "inputID" => "useLegacyPlayer",--}}
{{--                                "inputName" => "use_legacy_video_player",--}}
{{--                                "inputLabel" => "Use legacy video player.",--}}
{{--                                "checked" => (boolean) user()->use_legacy_video_player--}}
{{--                            ])--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="tw-flex tw-flex-row tw-py-6 tw-px-3 tw-flex-wrap sm:tw-flex-nowrap">
                    <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white sm:tw-mr-2 tw-w-full sm:tw-w-auto" type="submit">
                        Save
                    </button>
                    <button class="tw-btn-primary tw-bg-transparent tw-text-[#00101D] dark:tw-text-white dark:hover:tw-bg-white/10 hover:tw-bg-black/10 tw-w-full sm:tw-w-auto" type="reset">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('layout-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
            const emailToggle = document.getElementsByName('send_email')[1];
            const emailValue = document.getElementsByName('send_email')[0];
            const mobileToggle = document.getElementsByName('send_in_app_push_notification')[1];
            const mobileValue = document.getElementsByName('send_in_app_push_notification')[0];
            const originals = document.getElementsByClassName('original-toggle');
            const disables = document.getElementsByClassName('disabled-toggle');

            // email and mobile notification toggle handler
            const handleToggle = (toggleValue, otherToggleValue) => {
                if(toggleValue === '1' && otherToggleValue === '0'){
                    for(const original of originals){
                        original.classList.add('tw-hidden');
                    }

                    for(const disable of disables){
                        disable.classList.remove('tw-hidden');
                    }
                } else {
                    for(const original of originals){
                        original.classList.remove('tw-hidden');
                    }

                    for(const disable of disables){
                        disable.classList.add('tw-hidden');
                    }
                }
            }

            // run after the page loads
            handleToggle(emailValue.value === '1' ? '0' : '1', mobileValue.value);

            // notification toggle event listeners
            emailToggle.addEventListener('change', ()=>{
                handleToggle(emailValue.value, mobileValue.value);
            });
            mobileToggle.addEventListener('change', ()=>{
                handleToggle(mobileValue.value, emailValue.value);
            });

            // disabled toggle handler
            const clickDisabledToggle = (name) => {
                emailToggle.checked = true;
                emailValue.value = '1';
                mobileToggle.checked = true;
                mobileValue.value = '1';

                for(const original of originals){
                    const inputs = original.getElementsByTagName('input');

                    original.classList.remove('tw-hidden');
                    inputs[0].value = '0';
                    inputs[1].checked = false;
                }

                for(const disable of disables){
                    disable.classList.add('tw-hidden');
                }
            }

            // disabled toggle event listeners
            for(const disable of disables){
                disable.addEventListener('click', ()=>{
                    clickDisabledToggle();
                })
            }
        });
    </script>
@endsection
