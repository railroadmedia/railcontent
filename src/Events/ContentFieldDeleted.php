<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class ContentFieldDeleted extends Event
{
    public $contentId;

    public function __construct($contentId)
    {
        $this->contentId = $contentId;
    }
}