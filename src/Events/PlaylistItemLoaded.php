<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class PlaylistItemLoaded extends Event
{
    public $playlistId;
    public $playlistItemId;
    public $position;

    /**
     * @param $playlistId
     * @param $playlistItemId
     * @param $position
     */
    public function __construct($playlistId, $playlistItemId, $position)
    {
        $this->playlistId = $playlistId;
        $this->playlistItemId = $playlistItemId;
        $this->position = $position;
    }
}