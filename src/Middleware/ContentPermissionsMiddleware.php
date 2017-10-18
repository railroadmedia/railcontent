<?php

namespace Railroad\Railcontent\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        $this->contentService->setContentPermissionIds($request->get('user_content_permission_ids', []));

        return $next($request);
    }
}