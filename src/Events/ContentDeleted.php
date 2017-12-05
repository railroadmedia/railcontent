<?php

namespace Railroad\Railcontent\Events;


use Illuminate\Support\Facades\Event;

class ContentDeleted extends Event
{
    /**
     * @var int
     */
    public $contentId;

    public function __construct($contentId)
    {
        $this->contentId = $contentId;
    }
}