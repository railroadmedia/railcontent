<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class ContentUpdated extends Event
{
    public $contentId;
    public $contentArray;
    public $data;

    public function __construct($contentId, $contentArray, $data)
    {
        $this->contentId = $contentId;
        $this->contentArray = $contentArray;
        $this->data = $data;
    }
}