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
        $userPlaylist = $this->userPlaylistsService->getPlaylist($playlistId);
        $lastEngagedContent =
            $this->contentLastEngagedService->getLastEngagedContentForPlaylistId(user()->id, $playlistId);

        $nextItem = null;
        if ($lastEngagedContent) {
            $nextItem = $lastEngagedContent->content_id;
            $playlistItem = $this->userPlaylistsService->getPlaylistItemById($nextItem);
            if ($playlistItem) {
                $page = ($playlistItem['position'] <= 20) ? 1 : (ceil(($playlistItem['position']) / 20));

                ContentRepository::$bypassPermissions = true;
                ModeDecoratorBase::$decorationMode = DecoratorInterface::DECORATION_MODE_MAXIMUM;
                $playlistItems =
                    $this->userPlaylistsService->getUserPlaylistContents(
                        $playlistItem['user_playlist_id'],
                        [],
                        20,
                        $page
                    );
                ContentRepository::$bypassPermissions = false;
                $playlistItem =
                    $playlistItems->where('user_playlist_item_id', '=', $nextItem)
                        ->first();
            }
            if (!$playlistItem || ($playlistItem['completed'] == true)) {
                $items = $this->userPlaylistsService->getUserPlaylistContents($playlistId);
                $nextIncompleteItem =
                    $items->where('completed', false)
                        ->first() ?? $items->first();
                $nextItem = $nextIncompleteItem['user_playlist_item_id'] ?? null;
            }
        } elseif (isset($userPlaylist['user_playlist_item_id'])) {
            $nextItem = $userPlaylist['user_playlist_item_id'];
        }

        return $nextItem;
    }
}
