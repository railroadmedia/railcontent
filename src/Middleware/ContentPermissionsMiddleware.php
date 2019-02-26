<?php

namespace Railroad\Railcontent\Middleware;

use Closure;
use Illuminate\Http\Request;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ContentService;

class ContentPermissionsMiddleware
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * ContentPermissionsMiddleware constructor.
     *
     * @param ContentService $contentService
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * @param  Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->get('auth_level') === 'administrator') {

            // admins can see drafts, archived lessons, and future content by default
            ContentRepository::$availableContentStatues = $request->get(
                'statuses',
                [
                    ContentService::STATUS_PUBLISHED,
                    ContentService::STATUS_DRAFT,
                    ContentService::STATUS_SCHEDULED,
                    ContentService::STATUS_ARCHIVED,
                    ContentService::STATUS_DELETED,
                ]
            );
            CommentRepository::$softDelete = false;

            ContentRepository::$pullFutureContent = (bool)$request->get(
                'include_future',
                true
            );

            CommentService::$canManageOtherComments = true;
        } else {

            // users can only see published lessons

            ContentRepository::$availableContentStatues = [
                ContentService::STATUS_PUBLISHED,
                ContentService::STATUS_SCHEDULED,
            ];

            ContentRepository::$pullFutureContent = false;
        }

        return $next($request);
    }
}