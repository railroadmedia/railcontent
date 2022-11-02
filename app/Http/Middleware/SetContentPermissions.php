<?php

namespace App\Http\Middleware;

use App\Services\User\UserAccessService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Railroad\Railcontent\Entities\ContentEntity;
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
            ConfigService::$availableBrands = Arr::wrap(brand());

            if (user()->isAMember()) {
                ContentRepository::$bypassPermissions = true;

                ContentRepository::$pullFutureContent = (bool)$request->get(
                    'include_future',
                    false
                );
            }

            if (user()->isAdmin()) {

                // admins can see drafts, archived lessons, and future content by default
                ContentRepository::$bypassPermissions = true;

                ContentRepository::$availableContentStatues = $request->get(
                    'statuses',
                    [
                        ContentService::STATUS_PUBLISHED,
                        ContentService::STATUS_DRAFT,
                        ContentService::STATUS_SCHEDULED,
                        ContentService::STATUS_ARCHIVED,
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
