<?php

use App\Http\Controllers\Platform\CoachPagesController;
use App\Http\Controllers\Platform\CohortPackController;
use App\Http\Controllers\Platform\ContentPagesController;
use App\Http\Controllers\Platform\ExpiredMemberController;
use App\Http\Controllers\Platform\ForumPagesController;
use App\Http\Controllers\Platform\HomePageController;
use App\Http\Controllers\Platform\LegacyResourcesController;
use App\Http\Controllers\Platform\LivePageController;
use App\Http\Controllers\Platform\MailController;
use App\Http\Controllers\Platform\NotificationPagesController;
use App\Http\Controllers\Platform\PackPagesController;
use App\Http\Controllers\Platform\PaymentMethodUpdateController;
use App\Http\Controllers\Platform\ProfilePublicPagesController;
use App\Http\Controllers\Platform\ProfileSettingsPagesController;
use App\Http\Controllers\Platform\RedirectController;
use App\Http\Controllers\Platform\ReferralPagesController;
use App\Http\Controllers\Platform\SongsUpgradeController;
use App\Http\Controllers\Platform\SupportController;
use App\Http\Controllers\Platform\UserListPagesController;
use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Controllers\MusoraCenterContentController;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Middleware\AuthIfTokenExist;

Route::domain('{musoraDomain}')
    ->middleware(['web_authenticated'])
    ->group(function () {
        Route::domain('{musoraDomain}')
            ->middleware(['web_member_only'])
            ->group(function () {
                /*
                 * Home Page
                 */
                Route::get('/{brand}', [HomePageController::class, 'home'])
                    ->whereIn('brand', all_brands())
                    ->name('platform.home');

                Route::get(
                    '/redirect30day',
                    [\App\Http\Controllers\Platform\HomePageController::class, 'redirect30day']
                );

                /*
                 * Primary Content Pages
                 */
                Route::get('/{brand}/coaches', [CoachPagesController::class, 'coaches'])
                    ->whereIn('brand', all_brands())
                    ->name('platform.coaches');

                Route::get('/{brand}/lessons/all', [ContentPagesController::class, 'newLessonsPage'])
                    ->whereIn('brand', all_brands())
                    ->name('platform.new-lessons');

                Route::get('/{brand}/lessons/subscribed', [ContentPagesController::class, 'subscribedContent'])
                    ->whereIn('brand', all_brands())
                    ->name('platform.subscribed-lessons');


                Route::get('/{brand}/{contentTypeName}', [ContentPagesController::class, 'contentTypeCatalog'])
                    ->whereIn('brand', all_brands())
                    ->whereIn('contentTypeName', [
                        'lessons', // guitareo one-off page
                        'routines', // singeo one-off page
                        'courses',
                        'songs',
                        'quick-tips',
                        'podcasts',
                        'question-and-answer',
                        'student-reviews',
                        'boot-camps',
                        'chords-and-scales',
                        'bootcamps',
                        'chords-scales',
                        'library',
                        'recording',
                        'play-alongs',
                        'archives',
                        'spotlight',
                        'the-history-of-electronic-drums',
                        'backstage-secrets',
                        'student-collaborations',
                        'live-streams',
                        'solos',
                        'boot-amps',
                        'gear-guides',
                        'performances',
                        'in-rhythm',
                        'challenges',
                        'on-the-road',
                        'diy-drum-experiments',
                        'rhythmic-adventures-of-captain-carson',
                        'study-the-greats',
                        'rhythms-from-another-planet',
                        'tama-drums',
                        'paiste-cymbals',
                        'behind-the-scenes',
                        'exploring-beats',
                        'sonor-drums',
                        'rudiments',
                        'boot-camps',
                        'song-tutorials'
                    ])
                    ->name('platform.content-type-catalog');

                Route::get('/{brand}/shows', [ContentPagesController::class, 'shows'])
                    ->whereIn('brand', ['drumeo'])
                    ->name('platform.shows');

                Route::get('/{brand}/student-focus', [ContentPagesController::class, 'studentFocus'])
                    ->whereIn('brand', all_brands())
                    ->name('platform.student-focus');

                Route::get('/{brand}/play-alongs', [ContentPagesController::class, 'playAlongs'])
                    ->whereIn('brand', [Brand::Drumeo->value, Brand::Guitareo->value])
                    ->name('platform.play-alongs');

                Route::get('/{brand}/podcast', [ContentPagesController::class, 'podcast'])
                    ->whereIn('brand', [Brand::Drumeo->value, Brand::Pianote->value])
                    ->name('platform.podcast');

                Route::get('/{brand}/boot-camps', [ContentPagesController::class, 'bootCamps'])
                    ->whereIn('brand', [Brand::Drumeo->value, Brand::Pianote->value])
                    ->name('platform.boot-camps');

                Route::get('/{brand}/chords-and-scales', [ContentPagesController::class, 'chordsAndScales'])
                    ->whereIn('brand', [Brand::Pianote->value])
                    ->name('platform.chords-and-scales');

                Route::get('/{brand}/archives', [ContentPagesController::class, 'archives'])
                    ->whereIn('brand', [Brand::Drumeo->value, Brand::Guitareo->value])
                    ->name('platform.archives');

                Route::get('/{brand}/schedule', [ContentPagesController::class, 'schedule'])
                    ->whereIn('brand', all_brands())
                    ->name('platform.schedule');

                /*
                 * Specific Sub-Content Hierarchy Pages
                 */
                Route::get(
                    '/{brand}/coaches/{firstContentSlug}/{firstContentId}',
                    [CoachPagesController::class, 'show']
                )
                    ->whereIn('brand', all_brands())
                    ->name('platform.content.coach.show');

                /*
                 * Live & Schedule
                 */
                Route::get('/{brand}/live', [LivePageController::class, 'live'])
                    ->whereIn('brand', all_brands())
                    ->name('platform.live');

                Route::get('/{brand}/live-chat', [LivePageController::class, 'chat'])
                    ->whereIn('brand', all_brands())
                    ->name('platform.live-chat');

                /*
                 * Catch-All Sub-Content Hierarchy Pages / Video Lesson Pages
                 */
                Route::get(
                    '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}',
                    [ContentPagesController::class, 'firstLevel']
                )
                    ->whereIn('brand', all_brands())
                    ->whereIn(
                        'primaryPage',
                        [
                            'method',
                            'coaches',
                            'songs',
                            'courses',
                            'quick-tips',
                            'rudiments',
                            'bootcamps',
                            'chords-scales',
                            'podcasts',
                            'question-and-answer',
                            'spotlight',
                            'the-history-of-electronic-drums',
                            'backstage-secrets',
                            'student-collaborations',
                            'live-streams',
                            'podcasts',
                            'solos',
                            'boot-camps',
                            'gear-guides',
                            'performances',
                            'in-rhythm',
                            'challenges',
                            'on-the-road',
                            'diy-drum-experiments',
                            'rhythmic-adventures-of-captain-carson',
                            'study-the-greats',
                            'rhythms-from-another-planet',
                            'tama-drums',
                            'paiste-cymbals',
                            'behind-the-scenes',
                            'exploring-beats',
                            'sonor-drums',
                            'student-reviews',
                            'student-focus',
                            'archives',
                            'recording',
                            'play-alongs',
                            'song-tutorials',
                        ]
                    )
                    ->name('platform.content.first-level');

                Route::get('/{brand}/songs-upgrade',
                    [SongsUpgradeController::class, 'index']
                )->name('platform.songs-upgrade');

                Route::get(
                    '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}/{secondContentSlug}/{secondContentId}',
                    [ContentPagesController::class, 'secondLevel']
                )
                    ->whereIn('brand', all_brands())
                    ->whereIn('primaryPage', ['method', 'coaches', 'courses', 'songs', 'play-alongs','song-tutorials'])
                    ->name('platform.content.second-level');

                Route::get(
                    '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}/{secondContentSlug}/{secondContentId}/{thirdContentSlug}/{thirdContentId}',
                    [ContentPagesController::class, 'thirdLevel']
                )
                    ->whereIn('brand', all_brands())
                    ->whereIn('primaryPage', ['method'])
                    ->name('platform.content.third-level');

                Route::get(
                    '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}/{secondContentSlug}/{secondContentId}/{thirdContentSlug}/{thirdContentId}/{fourthContentSlug}/{fourthContentId}',
                    [ContentPagesController::class, 'fourthLevel']
                )
                    ->whereIn('brand', all_brands())
                    ->whereIn('primaryPage', ['method'])
                    ->name('platform.content.fourth-level');

                /*
                 * Referral Pages
                 */
                Route::domain('{musoraDomain}')
                    ->middleware([AuthIfTokenExist::class, 'web_authenticated'])
                    ->group(function () {
                        Route::get('/{brand}/referral/invite-a-friend', [ReferralPagesController::class, 'inviteAFriend'])
                            ->whereIn('brand', all_brands())
                            ->name('platform.invite-a-friend');
                    });
            });

        // anyone even without pack or a membership can access these

        /*
         * Redirect Helpers
         */
        // this automatically redirects to the users last used brand
        Route::get('/members', [HomePageController::class, 'homeRedirect'])
            ->whereIn('brand', all_brands())
            ->name('platform.home-redirect');

        // this automatically redirects to the users profile dashboard
        Route::get('/members/profile', [HomePageController::class, 'profileRedirect'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile-redirect');

        // this automatically redirects to the users notification settings
        Route::get('/members/profile/settings/payments', [HomePageController::class, 'paymentSettingsRedirect'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.payment-redirect');

        // this automatically redirects to the users notification settings
        Route::get('/members/profile/settings/notifications', [HomePageController::class, 'notificationSettingsRedirect'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.notifications-redirect');

        // this automatically redirects to the users notifications
        Route::get('/members/notifications', [HomePageController::class, 'notificationsRedirect'])
            ->whereIn('brand', all_brands())
            ->name('platform.notifications-redirect');

        Route::get('/purchase-redirect/{brand}', [RedirectController::class, 'redirectPurchase'])
            ->whereIn('brand', all_brands())
            ->name('platform.purchase-redirect');

        /*
        * Onboarding
        */
        Route::get('/onboarding', [HomePageController::class, 'onboarding'])
            ->whereIn('brand', all_brands())
            ->name('platform.onboarding');

        /*
         * Expired Members
         */
        Route::get('/membership-expired', [ExpiredMemberController::class, 'showExpiredMemberPage'])
            ->whereIn('brand', all_brands())
            ->name('platform.membership-expired');

        /*
         * Primary Content Pages
         */
        Route::get('/{brand}/packs', [PackPagesController::class, 'index'])
            ->whereIn('brand', ['drumeo', 'pianote', 'guitareo'])
            ->name('platform.packs');

        Route::get('/{brand}/search', [ContentPagesController::class, 'search'])
            ->whereIn('brand', all_brands())
            ->name('platform.search');

        /*
         * Packs Sub-Content Hierarchy Pages
         */
        Route::get('/{brand}/packs/{packSlug}/{packId}', [PackPagesController::class, 'packBundles'])
            ->whereIn('brand', all_brands())
            ->name('platform.packs.first-level');

        Route::get('/{brand}/packs/{packSlug}/{packId}/{packBundleSlug}/{packBundleId}',
                   [PackPagesController::class, 'packBundleLessons'])
            ->whereIn('brand', all_brands())
            ->name('platform.packs.second-level');

        Route::get(
            '/{brand}/packs/{packSlug}/{packId}/{packBundleSlug}/{packBundleId}/{packBundleLessonSlug}/{packBundleLessonId}',
            [PackPagesController::class, 'packBundleLesson'])
            ->whereIn('brand', all_brands())
            ->name('platform.packs.third-level');

        Route::get('/{brand}/semester-packs/{packSlug}/{packId}', [PackPagesController::class, 'packBundles'])
            ->whereIn('brand', all_brands())
            ->name('platform.semester-packs.first-level');

        Route::get(
            '/{brand}/semester-packs/{packSlug}/{packId}/{packLessonSlug}/{packLessonId}',
            [PackPagesController::class, 'semesterPackLesson']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.semester-packs.lesson');

        Route::get('/{brand}/coaches/{coachSlug}/{contentSlug}/{contentId}', [CoachPagesController::class, 'stream'])
            ->whereIn('brand', all_brands())
            ->name('platform.coach.first-level');

        Route::get(
            '/{brand}/content/{contentId}',
            [MusoraCenterContentController::class, 'showPreview']
        );

        /*
         * Jump-to redirects
         */
        Route::get(
            '/jump-to-content-id/{contentId}',
            [ContentPagesController::class, 'jumpToContentId']
        )
            ->name('platform.content.jump-to-content-id');

        Route::get('/jump-to-continue-content/{contentId}', [ContentPagesController::class, 'jumpToContinueContent'])
            ->name('platform.content.jump-to-continue-content');

        Route::get(
            '/{brand}/jump-to-comment/{contentId}/{commentId}',
            [ContentPagesController::class, 'jumpToContentComment']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.jump-to-comment');

        /*
         * Users Lists Pages
         */
        Route::get('/{brand}/lesson-history', [UserListPagesController::class, 'inProgress'])
            ->whereIn('brand', all_brands())
            ->name('platform.lesson-history');

        Route::get('/{brand}/lesson-history/in-progress', [UserListPagesController::class, 'inProgress'])
            ->whereIn('brand', all_brands())
            ->name('platform.lesson-history.in-progress');

        Route::get('/{brand}/lesson-history/completed', [UserListPagesController::class, 'completed'])
            ->whereIn('brand', all_brands())
            ->name('platform.lesson-history.completed');

        /*
         * Profile Public Pages
         */
        Route::get('/{brand}/profile/{userId}/dashboard', [ProfilePublicPagesController::class, 'dashboard'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.dashboard');

        /*
         * Profile Settings Pages
         */
        Route::get('/{brand}/profile/{userId}/settings/profile', [ProfileSettingsPagesController::class, 'profile'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.profile');

        Route::get('/{brand}/profile/{userId}/settings/login-credentials',
                   [ProfileSettingsPagesController::class, 'loginCredentials'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.login-credentials');

        Route::get('/{brand}/profile/{userId}/settings/payments', [ProfileSettingsPagesController::class, 'payments'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.payments');

        Route::get('/{brand}/profile/{userId}/settings/notifications',
                   [ProfileSettingsPagesController::class, 'notifications'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.notifications');

        Route::get('/{brand}/profile/{userId}/settings/account', [ProfileSettingsPagesController::class, 'account'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.account.id');

        Route::get('/{brand}/profile/settings/account', [ProfileSettingsPagesController::class, 'account'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.account');

        Route::put('/update-payment-method', [PaymentMethodUpdateController::class, 'submitUpdateForm'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.update-payment-method');

        Route::get(
            '/{brand}/profile/settings/cancellation-confirmed',
            [ProfileSettingsPagesController::class, 'cancellationConfirmation']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.cancellation-confirmed');

        // ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---
        // ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---   ---

        /*
         * Cancellation-related
         */
        // POST accept-annual-offer
        Route::post('/{brand}/profile/settings/account/accept-annual-offer',
                    [ProfileSettingsPagesController::class, 'acceptAnnualOffer'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.accept-annual-offer');

        // POST resume-paused
        Route::post('/{brand}/profile/settings/account/resume-paused',
                    [ProfileSettingsPagesController::class, 'resumePaused'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.resume-paused');

        // POST submit-cancel-reason
        Route::post('/{brand}/profile/settings/account/submit-cancel-reason',
                    [ProfileSettingsPagesController::class, 'submitCancelReason'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.submit-cancel-reason');

        // POST accept student-plan offer
        Route::post('/{brand}/profile/settings/account/student-plan-offer',
                    [ProfileSettingsPagesController::class, 'acceptStudentPlanOffer'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.student-plan-offer');

        // POST accept switch-to-monthly offer
        Route::post('/{brand}/profile/settings/account/switch-to-monthly',
                    [ProfileSettingsPagesController::class, 'acceptSwitchToMonthly'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.switch-to-monthly');

        // POST accept student-plan offer
        Route::post('/{brand}/profile/settings/account/gratis-access',
                    [ProfileSettingsPagesController::class, 'acceptGratisAccess'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.gratis-access');

        // POST accept student-plan offer
        Route::post(
            '/{brand}/profile/settings/account/accept-pause-offer',
            [ProfileSettingsPagesController::class, 'acceptPauseOffer']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.accept-pause-offer');

        Route::post(
            '/{brand}/profile/settings/account/send-help-email',
            [ProfileSettingsPagesController::class, 'sendHelpEmail']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.send-help-email');

        Route::post(
            '/{brand}/profile/settings/account/decline-offer-proceed-with-cancel',
            [ProfileSettingsPagesController::class, 'declineOfferProceedWithCancel']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.decline-offer-proceed-with-cancel');

        Route::post('/{brand}/profile/settings/account/send-help-email',
                    [ProfileSettingsPagesController::class, 'sendHelpEmail'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.send-help-email');

        // GET cancel-reason-form
        Route::get('/{brand}/profile/settings/account/cancel',
                   [ProfileSettingsPagesController::class, 'cancelReasonForm'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.cancel');

        // GET win-back
        Route::post('/{brand}/profile/settings/account/win-back', [ProfileSettingsPagesController::class, 'winBack'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.win-back');

        // - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -
        // (end of cancellation-related)
        // - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -   - -

        Route::get('/{brand}/profile/{userId}/settings/payment-invoice/{id}',
                   [ProfileSettingsPagesController::class, 'showInvoiceForPayment'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.payment-invoice');

        /*
         * Notifications Pages
         */
        Route::get('/{brand}/notifications', [NotificationPagesController::class, 'index'])
            ->whereIn('brand', all_brands())
            ->name('platform.notifications');

        /*
         * Forums
         */
        Route::get('/{brand}/forums', [ForumPagesController::class, 'showCategories'])
            ->whereIn('brand', all_brands())
            ->name('forums.show-categories');

        Route::get('/{brand}/forums/threads/latest', [ForumPagesController::class, 'showAllLatestThreads'])
            ->whereIn('brand', all_brands())
            ->name('forums.show-all-latest-threads');

        Route::get('/{brand}/forums/threads/{categorySlug}/{categoryId}',
                   [ForumPagesController::class, 'showCategoryThreads'])
            ->whereIn('brand', all_brands())
            ->name('forums.show-category-threads');

        Route::get('/{brand}/forums/{categorySlug}/{categoryId}/{threadSlug}/{threadId}',
                   [ForumPagesController::class, 'showThreadPosts'])
            ->whereIn('brand', all_brands())
            ->name('forums.show-thread-posts');

        Route::get('/{brand}/forums/jump-to-post/{postId}', [ForumPagesController::class, 'jumpToPost'])
            ->whereIn('brand', all_brands())
            ->name('forums.jump-to-post');

        Route::get('/{brand}/forums/jump-to-thread/{threadId}', [ForumPagesController::class, 'jumpToThread'])
            ->whereIn('brand', all_brands())
            ->name('forums.jump-to-thread');

        Route::get('/{brand}/forums/search', [ForumPagesController::class, 'getSearchResultsJson'])
            ->whereIn('brand', all_brands())
            ->name('forums.get-search-results-json');

        Route::get('/{brand}/forums/create-forum', [ForumPagesController::class, 'showCreateCategoryForm'])
            ->whereIn('brand', all_brands())
            ->name('forums.show-create-category-form');

        Route::get('/{brand}/forums/update-forum/{forumId}', [ForumPagesController::class, 'showUpdateCategoryForm'])
            ->whereIn('brand', all_brands())
            ->name('forums.show-update-category-form');

        Route::get('/{brand}/forums/threads/create-thread', [ForumPagesController::class, 'showCreateThreadForm'])
            ->whereIn('brand', all_brands())
            ->name('forums.show-create-thread-form');

        Route::get('/{brand}/forums/edit-thread/{threadId}', [ForumPagesController::class, 'showUpdateThreadForm'])
            ->whereIn('brand', all_brands())
            ->name('forums.show-update-thread-form');

        /*
         * Mails
         */
        Route::post('/{brand}/mail', [MailController::class, 'sendFromMember'])
            ->whereIn('brand', all_brands())
            ->name('platform.mail');

        /*
         * Support
         */
        Route::get('/{brand}/support', [SupportController::class, 'memberSupport'])
            ->whereIn('brand', all_brands())
            ->name('platform.support');

        /*
         * Drumeo legacy resources
         */
        Route::get('/{brand}/legacy-resources', [LegacyResourcesController::class, 'show'])
            ->whereIn('brand', ['drumeo'])
            ->name('platform.legacy-resources');

        Route::get('/{brand}/legacy-resources/archives', [LegacyResourcesController::class, 'archive'])
            ->whereIn('brand', ['drumeo'])
            ->name('platform.legacy-resources.archive');

        Route::get('/{brand}/legacy-resources/dictionary-of-terms', [LegacyResourcesController::class, 'dictionary'])
            ->whereIn('brand', ['drumeo'])
            ->name('platform.legacy-resources.dictionary');

        Route::get('/{brand}/legacy-resources/loops', [LegacyResourcesController::class, 'loops'])
            ->whereIn('brand', ['drumeo'])
            ->name('platform.legacy-resources.loops');

        /**
         * Pianote Foundation Book
         */
        Route::get('/{brand}/resources', [\App\Http\Controllers\Platform\BooksController::class, 'resources'])
            ->whereIn('brand', ['pianote'])
            ->name('platform.books.resources');

        Route::get(
            '/{brand}/resources/level-{chapterNumber}',
            [\App\Http\Controllers\Platform\BooksController::class, 'chapter']
        )
            ->whereIn('brand', ['pianote'])
            ->name('platform.books.resources.chapter');

//        //todo: to be moved outside members area
        //        //todo: to be moved outside members area
        Route::get('/{brand}/contact', [SupportController::class, 'contact'])
            ->whereIn('brand', all_brands())
            ->name('platform.contact');

        Route::post(
            '/{brand}/songs',
            [\Railroad\Railcontent\Controllers\RequestedSongsJsonController::class, 'requestSong']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.request-song');

        Route::get('/{brand}/enrollment/{cohort}', [CohortPackController::class, 'template'])
            ->name('platform.cohort');

        Route::get('/{brand}/enrollment/{cohort}/purchased', [CohortPackController::class, 'purchased'])
            ->name('platform.cohort.purchased');

        Route::get('{brand}/cohort-packs/register/{product}', [CohortPackController::class, 'register'] )
            ->name('platform.cohort.register');

        // New playlists
        Route::get('/{brand}/playlists', [\App\Http\Controllers\Platform\UserPlaylistsController::class, 'index'])
            ->whereIn('brand', all_brands())
            ->name('platform.user.playlists');

        Route::get('/{brand}/playlist/{playlistId}/playlist-item/{playlistItemId}', [\App\Http\Controllers\Platform\UserPlaylistsController::class, 'playlistItem'])
            ->whereIn('brand', all_brands())
            ->name('platform.user.playlist-item');

        Route::get('/{brand}/playlist/{id}', [\App\Http\Controllers\Platform\UserPlaylistsController::class, 'playlist'])
            ->whereIn('brand', all_brands())
            ->name('platform.user.playlist');
    });

/*
 * Referral Pages
 */
Route::domain('{musoraDomain}')
    ->middleware([AuthIfTokenExist::class, 'web_authenticated'])
    ->group(function () {
        Route::get('/{brand}/referral/invite-a-friend', [ReferralPagesController::class, 'inviteAFriend'])
            ->whereIn('brand', all_brands())
            ->name('platform.invite-a-friend');
    });

Route::get(
    '/apple-app-site-association',
    [\App\Http\Controllers\Misc\ManifestFilesController::class, 'appleAssociationFile']
)
    ->name('platform.apple-association-file');

Route::get(
    '/.well-known/assetlinks.json',
    [\App\Http\Controllers\Misc\ManifestFilesController::class, 'androidAssociationFile']
)
    ->name('platform.android-association-file');

    Route::domain('{musoraDomain}')
    ->middleware(['web_authenticated'])
    ->group(function () {
        /*
         * Home Page
         */
        Route::get('/{brand}/comments', [ContentPagesController::class, 'comments'])
            ->whereIn('brand', all_brands())
            ->name('platform.members-area.comments');
    });

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        /**
         * Pianote Foundation Book
         */
        Route::get('/{brand}/resources', [\App\Http\Controllers\Platform\BooksController::class, 'resources'])
            ->whereIn('brand', ['pianote'])
            ->name('platform.books.resources');

        Route::get(
            '/{brand}/resources/level-{chapterNumber}',
            [\App\Http\Controllers\Platform\BooksController::class, 'chapter']
        )
            ->whereIn('brand', ['pianote'])
            ->name('platform.books.resources.chapter');
        /**
         * Drumeo Best Beginner Drum Book
         */
        Route::get('/{brand}/bestbook', [\App\Http\Controllers\Platform\BooksController::class, 'bestBeginner'])
            ->whereIn('brand', ['drumeo'])
            ->name('books.best-beginner-drum-book');

        Route::get('/{brand}/bestbook/play-alongs',
                   [\App\Http\Controllers\Platform\BooksController::class, 'bestBeginnerPlayAlongs'])
            ->whereIn('brand', ['drumeo'])
            ->name('books.best-beginner-drum-book.play-alongs');

        Route::get('/{brand}/bestbook-digital', [\App\Http\Controllers\Platform\BooksController::class, 'bestBeginner'])
            ->whereIn('brand', ['drumeo'])
            ->name('books.best-beginner-drum-book-digital');
        /**
         * Drumeo Drummer's Toolbox Book
         */
        Route::get(
            '/{brand}/drummers-toolbox-digital',
            [\App\Http\Controllers\Platform\BooksController::class, 'drummersToolbox']
        )
            ->whereIn('brand', ['drumeo'])
            ->name('books.digital.drummers-toolbox');

        Route::get(
            '/{brand}/drummers-toolbox-digital/{chapterNumber}',
            [\App\Http\Controllers\Platform\BooksController::class, 'drummersToolboxChapter']
        )
            ->whereIn('brand', ['drumeo'])
            ->name('books.digital.drummers-toolbox.chapter');

        Route::get(
            '/{brand}/drummers-toolbox',
            [\App\Http\Controllers\Platform\BooksController::class, 'drummersToolbox']
        )
            ->whereIn('brand', ['drumeo'])
            ->name('books.drummers-toolbox');

        Route::get(
            '/{brand}/drummers-toolbox/trial',
            [\App\Http\Controllers\Platform\BooksController::class, 'drummersToolbox']
        )
            ->whereIn('brand', ['drumeo'])
            ->name('books.drummers-toolbox.trial');

        Route::get(
            '/{brand}/drummers-toolbox/{chapterNumber}',
            [\App\Http\Controllers\Platform\BooksController::class, 'drummersToolboxChapter']
        )
            ->whereIn('brand', ['drumeo'])
            ->name('books.drummers-toolbox.chapter');
    });


Route::middleware(['web_authenticated'])
    ->group(function () {
        Route::get('/test/email', [HomePageController::class, 'testemail']);
    });
