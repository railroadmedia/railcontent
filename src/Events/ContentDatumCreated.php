<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class ContentDatumCreated extends Event
{
    public $contentId;
    public $input;

    public function __construct($contentId, $input)
    {
        $this->contentId = $contentId;
        $this->input = $input;
    }
}