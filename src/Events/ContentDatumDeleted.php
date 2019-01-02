<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class ContentDatumDeleted extends Event
{
    public $contentId;
    public $datum;

    public function __construct($contentId, $datum)
    {
        $this->contentId = $contentId;
        $this->datum = $datum;
    }
}