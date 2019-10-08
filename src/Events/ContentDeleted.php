<?php

namespace Railroad\Railcontent\Events;


use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\Content;

class ContentDeleted extends Event
{
    /**
     * @var Content
     */
    public $content;

    public $contentId;

    /**
     * ContentDeleted constructor.
     *
     * @param Content $content
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
        $this->contentId = $content->getId();
    }
}