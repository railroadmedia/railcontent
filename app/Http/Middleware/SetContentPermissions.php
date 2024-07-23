<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class SetContentPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (!empty(user()) && !empty(brand())) {
            ConfigService::$brand = brand();
            ConfigService::$availableBrands = Arr::wrap([brand()]);

            if (user()->isAMember()) {

                ContentRepository::$pullFutureContent = (bool)$request->get(
                    'include_future',
                    false
                );
            }

            if (user()->isABasicMember()) {
                ContentRepository::$allowsPullSongsContent = true;
            }

            if (user()->isAdmin()) {

                // admins can see drafts, archived lessons, and future content by default
                ContentRepository::$bypassPermissions = true;
                // if there is a 'scheduled' content, but from a past date, the admins ca still see the content's page, but they will not see it catalogue's content list
                ContentRepository::$getFutureScheduledContentOnly = false;

                ContentRepository::$availableContentStatues = $request->get(
                    'statuses',
                    [
                        ContentService::STATUS_PUBLISHED,
                        ContentService::STATUS_DRAFT,
                        ContentService::STATUS_SCHEDULED,
                        ContentService::STATUS_ARCHIVED,
                        ContentService::STATUS_UNLISTED,
                    ]
                );

                ContentRepository::$pullFutureContent = (bool)$request->get(
                    'include_future',
                    true
                );

                CommentService::$canManageOtherComments = true;
            } else {
                ContentRepository::$availableContentStatues =
                    [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED];
                ContentRepository::$pullFutureContent = (bool)$request->get(
                    'include_future',
                    false
                );
            }
        }
        return $next($request);
    }
}
