<?php

namespace App\Listeners\Content;

use Railroad\Railcontent\Events\PlaylistItemLoaded;
use Railroad\Railcontent\Services\UserPlaylistsService;
use App\Modules\RailTracker\Events\EngageContent;
use App\Modules\RailTracker\Services\ContentLastEngagedService;

class EngageContentEventListener
{
    private ContentLastEngagedService $contentLastEngagedService;
    private UserPlaylistsService $userPlaylistService;

    public function __construct(ContentLastEngagedService $contentLastEngagedService, UserPlaylistsService $userPlaylistService)
    {
        $this->contentLastEngagedService = $contentLastEngagedService;
        $this->userPlaylistService = $userPlaylistService;
    }

    public function handleEngageContent(PlaylistItemLoaded $event)
    {
        $item = $this->userPlaylistService->getPlaylistItemById($event->playlistItemId);

        $this->userPlaylistService->updatePlaylistsLastProgress($item['content_id'], brand());
        $this->contentLastEngagedService->engageContent(user()->id, $event->playlistItemId, $event->playlistId);
    }

    public function handleRemoveEngageContent($event)
    {
        $deleted = $this->contentLastEngagedService->deleteEngagedContent(user()->id, $event->playlistId, null);
        if(isset($event->playlistItemId) && ($deleted == 1) && ($event->position > 1)) {
            $previousPlaylistItem = $this->userPlaylistService->getItemWithPositionInPlaylist($event->playlistId, ($event->position - 1));
            $this->contentLastEngagedService->engageContent(user()->id, $previousPlaylistItem['id'], $event->playlistId, null);
        }
    }
}
