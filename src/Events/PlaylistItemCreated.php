<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class PlaylistItemCreated extends Event
{
    public $playlistId;
    public $playlistItemId;

    /**
     * @param $playlistId
     */
    public function __construct($playlistId, $playlistItemId)
    {
        $this->playlistId = $playlistId;
        $this->playlistItemId = $playlistItemId;
    }
}