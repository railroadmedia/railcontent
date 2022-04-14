@extends('account.settings.layout')

@section('meta')
    <title>Settings | Musora</title>
@endsection

@section('edit-forms')
    <div class="tw-flex tw-flex-col pa-3 tw-flex-auto">
        <h1 class="heading">Settings</h1>
    </div>
    <div class="tw-flex tw-flex-row">
        <div id="editForm" class="tw-flex tw-flex-col">
            <form method="POST" action="/usora/user/update/{{ current_user()->getId() }}">
                <input type="hidden" name="redirect" value="{{ url()->current() }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                <div class="tw-flex tw-flex-row tw-flex-auto bt-grey-1-1 pa-3">
                    <h2 class="subheading">When would you like to receive email notifications?</h2>
                </div>

                <div class="tw-flex tw-flex-row ph-3 pb-3">
                    <div class="tw-flex tw-flex-col">
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "weeklyUpdates",
                                "inputName" => "notify_weekly_update",
                                "inputLabel" => "Weekly Community Updates.",
                                "checked" => (boolean) current_user()->getNotifyWeeklyUpdate()
                            ])
                        </div>
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "repliesComment",
                                "inputName" => "notify_on_lesson_comment_reply",
                                "inputLabel" => "When a member replies to my lesson comment.",
                                "checked" => (boolean) current_user()->getNotifyOnLessonCommentReply()
                            ])
                        </div>
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "likesComment",
                                "inputName" => "notify_on_lesson_comment_like",
                                "inputLabel" => "When a member likes my lesson comment.",
                                "checked" => (boolean) current_user()->getNotifyOnLessonCommentLike()
                            ])
                        </div>
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "repliesForum",
                                "inputName" => "notify_on_forum_followed_thread_reply",
                                "inputLabel" => "When a member posts in a forum thread I created or follow.",
                                "checked" => (boolean) current_user()->getNotifyOnForumFollowedThreadReply()
                            ])
                        </div>
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "likesForum",
                                "inputName" => "notify_on_forum_post_like",
                                "inputLabel" => "When a member likes my forum posts",
                                "checked" => (boolean) current_user()->getNotifyOnForumPostLike()
                            ])
                        </div>
                    </div>
                </div>

                <div class="tw-flex tw-flex-row tw-flex-auto bt-grey-1-1 pa-3">
                    <h2 class="subheading">How often would you like to receive email notifications?</h2>
                </div>
                <div class="tw-flex tw-flex-row ph-3 pb-3">
                    <div class="tw-flex tw-flex-col">
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.radio-input', [
                                "inputID" => "rightAway",
                                "inputName" => "notifications_summary_frequency_minutes",
                                "inputLabel" => "Send me notifications right away.",
                                "inputValue" => null,
                                "checked" => current_user()->getNotificationsSummaryFrequencyMinutes() === null
                            ])
                        </div>

                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.radio-input', [
                                "inputID" => "perDay",
                                "inputName" => "notifications_summary_frequency_minutes",
                                "inputLabel" => "Email me a summary of my notifications once per day.",
                                "inputValue" => 1440,
                                "checked" => current_user()->getNotificationsSummaryFrequencyMinutes() === 1440
                            ])
                        </div>
                    </div>
                </div>

                <div class="tw-flex tw-flex-row tw-flex-auto bt-grey-1-1 pa-3" style="padding-bottom: 10px;">
                    <h2 class="subheading">Would you like to use our legacy video player?</h2>
                </div>
                <div class="tw-flex tw-flex-row tw-flex-auto ph-3">
                    <p class="body">Our video player may have compatibility issues with older devices and operating systems. <br>We recommend switching to our legacy video player if you are experiencing playback issues.</p>
                </div>

                <div class="tw-flex tw-flex-row ph-3 pb-3 pt-3">
                    <div class="tw-flex tw-flex-col">
                        <div class="tw-flex tw-flex-row tw-mb-2">
                            @include('partials.bladesora.members.inputs.toggle-input', [
                                "inputID" => "useLegacyPlayer",
                                "inputName" => "use_legacy_video_player",
                                "inputLabel" => "Use legacy video player.",
                                "checked" => (boolean) current_user()->getUseLegacyVideoPlayer()
                            ])
                        </div>
                    </div>
                </div>

                <div class="tw-flex tw-flex-row pa-3">
                    <button class="btn collapse-150" type="submit">
                        <span class="tw-bg-{{ $brand }} tw-text-white short">
                            Save
                        </span>
                    </button>
                    <button class="btn collapse-150 tw-ml-1" type="reset">
                        <span class="flat tw-text-black short">
                            Cancel
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
