<?php

namespace App\Services;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railtracker\Services\ContentLastEngagedService;

class PlaylistService
{
    private ContentLastEngagedService $contentLastEngagedService;
    private UserPlaylistsService $userPlaylistsService;
    private ContentService $contentService;

    /**
     * @param ContentLastEngagedService $contentLastEngagedService
     * @param UserPlaylistsService $userPlaylistsService
     * @param ContentService $contentService
     */
    public function __construct(
        ContentLastEngagedService $contentLastEngagedService,
        UserPlaylistsService $userPlaylistsService,
        ContentService $contentService
    ) {
        $this->contentLastEngagedService = $contentLastEngagedService;
        $this->userPlaylistsService = $userPlaylistsService;
        $this->contentService = $contentService;
    }

    /**
     * @param $playlistId
     * @return mixed|null
     */
    public function getPlaylistNextItem($playlistId)
    {
        $lastEngagedContent =
            $this->contentLastEngagedService->getLastEngagedContentForPlaylistId(user()->id, $playlistId);
        if ($lastEngagedContent) {
            $nextItem     = $lastEngagedContent->content_id;
            $playlistItem = $this->userPlaylistsService->getPlaylistItemById($nextItem);
            if ($playlistItem) {
                $page                                 = ($playlistItem['position'] <= 20) ? 1 : (ceil(($playlistItem['position']) / 20));
                $initialByPassPermissions             = ContentRepository::$bypassPermissions;
                ContentRepository::$bypassPermissions = true;
                ModeDecoratorBase::$decorationMode    = DecoratorInterface::DECORATION_MODE_MAXIMUM;
                array_push(ContentRepository::$availableContentStatues, ContentService::STATUS_UNLISTED);
                $playlistItems                        =
                    $this->userPlaylistsService->getUserPlaylistContents(
                        $playlistItem['user_playlist_id'],
                        [],
                        20,
                        $page
                    );
                ContentRepository::$bypassPermissions = $initialByPassPermissions;
                $playlistItem                         =
                    $playlistItems->where('user_playlist_item_id', '=', $nextItem)
                        ->first();
            }
            if (!$playlistItem || ($playlistItem['completed'] == true)) {
                $items              = $this->userPlaylistsService->getUserPlaylistContents($playlistId);
                $nextIncompleteItem =
                    $items->where('completed', false)
                        ->first() ?? $items->first();
                $nextItem           = $nextIncompleteItem['user_playlist_item_id'] ?? null;
            }
        } else {
            $playlistItems = $this->userPlaylistsService->getUserPlaylistContents($playlistId, [], 1, 1);

            $nextItem = $playlistItems->first() ? $playlistItems->first()['user_playlist_item_id'] : null;
        }

        return $nextItem;
    }
}
