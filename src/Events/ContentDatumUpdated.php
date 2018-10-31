<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class ContentDatumUpdated extends Event
{
    public $contentId;
    public $datum;
    public $input;

    public function __construct($contentId, $datum, $input)
    {
        $this->contentId = $contentId;
        $this->datum = $datum;
        $this->input = $input;
    }
}