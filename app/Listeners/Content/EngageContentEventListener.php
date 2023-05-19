<?php

namespace App\Listeners\Content;

use Railroad\Railcontent\Events\PlaylistItemLoaded;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railtracker\Events\EngageContent;
use Railroad\Railtracker\Services\ContentLastEngagedService;

class EngageContentEventListener
{
    private ContentLastEngagedService $contentLastEngagedService;
    private UserPlaylistsService $userPlaylistService;

    /**
     * @param ContentLastEngagedService $contentLastEngagedService
     */
    public function __construct(ContentLastEngagedService $contentLastEngagedService, UserPlaylistsService $userPlaylistService)
    {
        $this->contentLastEngagedService = $contentLastEngagedService;
        $this->userPlaylistService = $userPlaylistService;
    }

    public function handleEngageContent(PlaylistItemLoaded $event)
    {
        $this->contentLastEngagedService->engageContent(user()->id, $event->playlistItemId, $event->playlistId);
    }

    public function handleRemoveEngageContent($event)
    {
        $deleted = $this->contentLastEngagedService->deleteEngagedContent(user()->id, $event->playlistId, null);
        if(isset($event->playlistItemId) && ($deleted == 1) && ($event->position > 1)){
            $previousPlaylistItem = $this->userPlaylistService->getItemWithPositionInPlaylist($event->playlistId, ($event->position -1));
            $this->contentLastEngagedService->engageContent(user()->id, $previousPlaylistItem['id'], $event->playlistId, null);
        }
    }
}
