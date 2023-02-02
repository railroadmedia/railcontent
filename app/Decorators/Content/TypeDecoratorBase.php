<?php

namespace App\Decorators\Content;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Services\ContentFollowsService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;

abstract class TypeDecoratorBase extends ModeDecoratorBase
{
    /**
     * @var ContentService
     */
    protected $contentService;

    /**
     * @var UserContentProgressService
     */
    protected $userContentProgressService;

    /**
     * @var ContentHierarchyService
     */
    protected $contentHierarchyService;
    /**
     * @var ContentFollowsService
     */
    protected $contentFollowsService;

    public function __construct(
        ContentService $contentService,
        UserContentProgressService $userContentProgressService,
        ContentHierarchyService $contentHierarchyService,
        ContentFollowsService $contentFollowsService
    ) {
        $this->contentService = $contentService;
        $this->userContentProgressService = $userContentProgressService;
        $this->contentHierarchyService = $contentHierarchyService;
        $this->contentFollowsService = $contentFollowsService;
    }

    /**
     * @param Collection $originalContents
     * @param Collection $decoratedContents
     * @return Collection
     */
    public function mergeDecorated(Collection $originalContents, Collection $decoratedContents)
    {
        foreach ($originalContents as $originalContentIndex => $originalContent) {
            foreach ($decoratedContents as $decoratedContent) {
                if(isset($decoratedContent['user_playlist_item_id']) && isset($originalContent['user_playlist_item_id'])){
                    if ($decoratedContent['user_playlist_item_id'] == $originalContent['user_playlist_item_id']) {
                        $originalContents[$originalContentIndex] = $decoratedContent;
                    }
                }
                elseif ($decoratedContent['id'] == $originalContent['id']) {
                    $originalContents[$originalContentIndex] = $decoratedContent;
                }
            }
        }

        return $originalContents;
    }
}
