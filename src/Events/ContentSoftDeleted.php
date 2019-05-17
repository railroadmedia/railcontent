<?php

namespace Railroad\Railcontent\Events;


use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\Content;

class ContentSoftDeleted extends Event
{
    /**
     * @var Content
     */
    public $content;

    /**
     * ContentSoftDeleted constructor.
     *
     * @param Content $content
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }
}