<?php

use App\Http\Controllers\Platform\CoachPagesController;
use App\Http\Controllers\Platform\ContentPagesController;
use App\Http\Controllers\Platform\ForumPagesController;
use App\Http\Controllers\Platform\HomePageController;
use App\Http\Controllers\Platform\LivePageController;
use App\Http\Controllers\Platform\MailController;
use App\Http\Controllers\Platform\NotificationPagesController;
use App\Http\Controllers\Platform\PackPagesController;
use App\Http\Controllers\Platform\ProfilePublicPagesController;
use App\Http\Controllers\Platform\ProfileSettingsPagesController;
use App\Http\Controllers\Platform\ReferralPagesController;
use App\Http\Controllers\Platform\SupportController;
use App\Http\Controllers\Platform\UserListPagesController;
use App\Http\Controllers\Platform\LegacyResourcesController;
use Modules\UserManagementSystem\Middleware\AuthIfTokenExist;
use App\Modules\Brand\Enums\Brand;
use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->middleware(['web_authenticated'])
    ->group(function () {
        /*
         * Home Page
         */
        Route::get('/{brand}', [HomePageController::class, 'home'])
            ->whereIn('brand', all_brands())
            ->name('platform.home');

        // this automatically redirects to the users last used brand
        Route::get('/members', [HomePageController::class, 'homeRedirect'])
            ->whereIn('brand', all_brands())
            ->name('platform.home-redirect');

        /*
        * Onboarding
        */
        Route::get('/onboarding', [HomePageController::class, 'onboarding'])
            ->whereIn('brand', all_brands())
            ->name('platform.onboarding');


        /*
         * Primary Content Pages
         */
        Route::get('/{brand}/packs', [PackPagesController::class, 'index'])
            ->whereIn('brand', ['drumeo', 'pianote', 'guitareo'])
            ->name('platform.packs');

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

        Route::get('/{brand}/search', [ContentPagesController::class, 'search'])
            ->whereIn('brand', all_brands())
            ->name('platform.search');

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
         * Packs Sub-Content Hierarchy Pages
         */
        Route::get('/{brand}/packs/{packSlug}/{packId}', [PackPagesController::class, 'packBundles'])
            ->whereIn('brand', all_brands())
            ->name('platform.packs.first-level');

        Route::get(
            '/{brand}/packs/{packSlug}/{packId}/{packBundleSlug}/{packBundleId}',
            [PackPagesController::class, 'packBundleLessons']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.packs.second-level');

        Route::get(
            '/{brand}/packs/{packSlug}/{packId}/{packBundleSlug}/{packBundleId}/{packBundleLessonSlug}/{packBundleLessonId}',
            [PackPagesController::class, 'packBundleLesson']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.packs.third-level');

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
                    'packs',
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
                ]
            )
            ->name('platform.content.first-level');

        Route::get(
            '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}/{secondContentSlug}/{secondContentId}',
            [ContentPagesController::class, 'secondLevel']
        )
            ->whereIn('brand', all_brands())
            ->whereIn('primaryPage', ['packs', 'method', 'coaches', 'courses','songs', 'play-alongs'])
            ->name('platform.content.second-level');

        Route::get(
            '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}/{secondContentSlug}/{secondContentId}/{thirdContentSlug}/{thirdContentId}',
            [ContentPagesController::class, 'thirdLevel']
        )
            ->whereIn('brand', all_brands())
            ->whereIn('primaryPage', ['packs', 'method'])
            ->name('platform.content.third-level');

        Route::get(
            '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}/{secondContentSlug}/{secondContentId}/{thirdContentSlug}/{thirdContentId}/{fourthContentSlug}/{fourthContentId}',
            [ContentPagesController::class, 'fourthLevel']
        )
            ->whereIn('brand', all_brands())
            ->whereIn('primaryPage', ['method'])
            ->name('platform.content.fourth-level');

        Route::get(
            '/jump-to-content-id/{contentId}',
            [ContentPagesController::class, 'jumpToContentId']
        )
            ->name('platform.content.jump-to-content-id');

        Route::get(
            '/jump-to-continue-content/{contentId}',
            [ContentPagesController::class, 'jumpToContinueContent']
        )
            ->name('platform.content.jump-to-continue-content');

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
         * Users Lists Pages
         */
        Route::get('/{brand}/lists/my-list', [UserListPagesController::class, 'myList'])
            ->whereIn('brand', all_brands())
            ->name('platform.lists.my-list');

        Route::get('/{brand}/lists/in-progress', [UserListPagesController::class, 'inProgress'])
            ->whereIn('brand', all_brands())
            ->name('platform.lists.in-progress');

        Route::get('/{brand}/lists/completed', [UserListPagesController::class, 'completed'])
            ->whereIn('brand', all_brands())
            ->name('platform.lists.completed');

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

        Route::get(
            '/{brand}/profile/{userId}/settings/login-credentials',
            [ProfileSettingsPagesController::class, 'loginCredentials']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.login-credentials');

        Route::get('/{brand}/profile/{userId}/settings/payments', [ProfileSettingsPagesController::class, 'payments'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.payments');

        Route::get(
            '/{brand}/profile/{userId}/settings/notifications',
            [ProfileSettingsPagesController::class, 'notifications']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.notifications');

        Route::get(
            '/{brand}/profile/{userId}/settings/membership',
            [ProfileSettingsPagesController::class, 'membership']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.membership');

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

        Route::get(
            '/{brand}/forums/threads/{categorySlug}/{categoryId}',
            [ForumPagesController::class, 'showCategoryThreads']
        )
            ->whereIn('brand', all_brands())
            ->name('forums.show-category-threads');

        Route::get(
            '/{brand}/forums/{categorySlug}/{categoryId}/{threadSlug}/{threadId}',
            [ForumPagesController::class, 'showThreadPosts']
        )
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

        Route::get('/{brand}/resources/level-{chapterNumber}', [\App\Http\Controllers\Platform\BooksController::class, 'chapter'])
            ->whereIn('brand', ['pianote'])
            ->name('platform.books.resources.chapter');

//        //todo: to be moved outside members area
        Route::get('/{brand}/contact', [SupportController::class, 'contact'])
            ->whereIn('brand', all_brands())
            ->name('platform.contact');
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

Route::get('/apple-app-site-association', function () {
    $json = file_get_contents(base_path('apple-app-site-association'));
    return response($json, 200)
        ->header('Content-Type', 'application/json');
});
