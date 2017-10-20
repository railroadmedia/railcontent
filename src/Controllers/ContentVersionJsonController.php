<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Services\ContentService;

class ContentVersionJsonController extends Controller
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * ContentVersionJsonController constructor.
     * @param ContentService $contentService
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * Call the restore content method and return the new content in JSON format
     *
     * @param integer $versionId
     * @return JsonResponse
     */
    public function restoreContent($versionId)
    {
        // todo: move to ContentVersionController

        //get the content data saved in the database for the version id
        $version = $this->contentService->getContentVersion($versionId);

        if (is_null($version)) {
            return response()->json('Restore content failed, version not found with id: ' . $versionId, 404);
        }

        //restore content
        $restored = $this->contentService->restoreContent($versionId);

        return response()->json($restored, 200);
    }
}