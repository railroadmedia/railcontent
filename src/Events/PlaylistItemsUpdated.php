<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class PlaylistItemsUpdated extends Event
{
    public $playlistId;

    /**
     * @param int $userId
     * @param array $contentIds
     */
    public function __construct($playlistId)
    {
        $this->playlistId = $playlistId;
    }
}