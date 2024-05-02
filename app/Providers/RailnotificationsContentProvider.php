<?php

namespace App\Providers;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Transformers\ContentTransformer;
use Railroad\Railnotifications\Contracts\ContentProviderInterface;

class RailnotificationsContentProvider implements ContentProviderInterface
{
    private ContentService $contentService;
    private CommentService $commentService;

    /**
     * @param ContentService $contentService
     * @param CommentService $commentService
     */
    public function __construct(ContentService $contentService, CommentService $commentService)
    {
        $this->contentService = $contentService;
        $this->commentService = $commentService;
    }

    public function getContentById($id)
    {
        ContentRepository::$bypassPermissions = true;

        $content = $this->contentService->getById($id);
        $content['mobile_app_url'] = url()->route('v1.mobile.musora-api.content.show', ['id' => $id, 'brand' => $content['brand']]);
        return $content;
    }

    public function getCommentById($id)
    {
        return $this->commentService->get($id);
    }

    public function getContentTransformer()
    {
        return new ContentTransformer();
    }
}
