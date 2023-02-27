<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class PlaylistItemsUpdated extends Event
{
    public $playlistId;

    /**
     * @param $playlistId
     */
    public function __construct($playlistId)
    {
        $this->playlistId = $playlistId;
    }
}