<?php

namespace Railroad\Railcontent\Events;


use Illuminate\Support\Facades\Event;

class ContentFieldCreated extends Event
{
    public $contentId;

    public function __construct($contentId)
    {
        $this->contentId = $contentId;
    }
}