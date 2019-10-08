<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\Content;

class ContentDatumDeleted extends Event
{
    /**
     * @var Content
     */
    public $content;

    public $contentId;

    /**
     * ContentDatumDeleted constructor.
     *
     * @param Content $content
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
        $this->contentId = $content->getId();
    }
}