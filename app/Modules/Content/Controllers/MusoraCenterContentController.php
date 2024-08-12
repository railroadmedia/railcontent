<?php

namespace App\Modules\Content\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
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

    public function showPreview($domain, $brand, $contentId): RedirectResponse
    {
        ConfigService::$availableBrands = [$brand];
        ContentRepository::$pullFutureContent = true;

        $content = $this->contentService->getById($contentId);

        if ($content && $content['url']) {
            return redirect($content['url']);
        }
        Log::debug("showPreview failed: $domain $brand $contentId");
        abort(404);
    }
}
