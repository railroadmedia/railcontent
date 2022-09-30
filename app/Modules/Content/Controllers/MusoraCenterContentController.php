<?php

namespace App\Modules\Content\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class MusoraCenterContentController extends Controller
{
    private ContentService $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function showPreview($brand, $contentId)
    {
        ConfigService::$availableBrands = [$brand];
        ContentRepository::$pullFutureContent = true;

        $content = $this->contentService->getById($contentId);

        if ($content && $content['url']) {
            return redirect($content['url']);
        }
        abort(404);
    }
}
