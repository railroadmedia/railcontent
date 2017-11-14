<?php

namespace Railroad\Railcontent\Events;


use Illuminate\Support\Facades\Event;

class CommentCreated extends Event
{
    public $commentId;

    public $contentType;

    public function __construct($commentId, $contentType)
    {
        $this->commentId = $commentId;
        $this->contentType = $contentType;
    }
}