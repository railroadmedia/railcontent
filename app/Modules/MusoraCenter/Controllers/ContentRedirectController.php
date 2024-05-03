<?php

namespace App\Modules\MusoraCenter\Controllers;

use App\Modules\MusoraCenter\Services\UrlHelperService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ContentRedirectController extends Controller
{
    /**
     * @var ContentService
     */
    private $contentService;
    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;
    /**
     * @var UrlHelperService
     */
    private $urlHelperService;

    /**
     * ContentRedirectController constructor.
     */
    public function __construct(
        ContentService $contentService,
        ContentHierarchyService $contentHierarchyService,
        UrlHelperService $urlHelperService
    ) {
        $this->contentService = $contentService;
        $this->contentHierarchyService = $contentHierarchyService;
        $this->urlHelperService = $urlHelperService;
    }

    public function redirectToId(Request $request, $id)
    {
        ContentRepository::$availableContentStatues = false;
        ContentRepository::$pullFutureContent = true;
        ContentRepository::$bypassPermissions = true;

        $queryString = !empty($request->getQueryString()) ? '?' . $request->getQueryString() : '';

        $url = $this->urlHelperService->getUrlFromId($id, $queryString);

        if (!empty($url)) {
            return redirect()->away($url);
        }

        throw new NotFoundHttpException();
    }
}
