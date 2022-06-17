<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class ElasticDataShouldUpdate extends Event
{
    public $contentId;
    public $contentType;

    public function __construct($contentId = null, $contentType = null)
    {
        $this->contentId = $contentId;
        $this->contentType = $contentType;
    }
}