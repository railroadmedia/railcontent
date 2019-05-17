<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\Content;

class ContentUpdated extends Event
{
    /**
     * @var Content
     */
    public $content;

    /**
     * ContentUpdated constructor.
     *
     * @param Content $content
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }
}