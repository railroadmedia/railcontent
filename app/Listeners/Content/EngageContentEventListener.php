<?php

namespace App\Listeners\Content;

use App\Modules\Content\Models\UserPlaylist;
use App\Modules\Content\Models\UserPlaylistContent;
use Carbon\Carbon;
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
        $playlist = UserPlaylist::with('items')->where('id', '=',  $event->playlistId)->first();
        $playlist->last_progress = Carbon::now()->toDateTimeString();
        $playlist->save();
        $item = $playlist->items->where('id',$event->playlistItemId)->first();
        $this->contentLastEngagedService->engageContent(user()->id, $item->content_id, $event->playlistId);
    }

    public function handleRemoveEngageContent($event)
    {
        $deleted = $this->contentLastEngagedService->deleteEngagedContent(user()->id, $event->playlistId, null);
        if (isset($event->playlistItemId) && ($deleted == 1) && ($event->position > 1)) {
            $previousPlaylistItem = $this->userPlaylistService->getItemWithPositionInPlaylist($event->playlistId, ($event->position - 1));
            $this->contentLastEngagedService->engageContent(user()->id, $previousPlaylistItem['id'], $event->playlistId, null);
        }
    }
}
