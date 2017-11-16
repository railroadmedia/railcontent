<?php

namespace Railroad\Railcontent\Events;


use Illuminate\Support\Facades\Event;

class CommentCreated extends Event
{
    public $comment;

    public $contentType;

    public function __construct($comment, $contentType)
    {
        $this->comment = $comment;
        $this->contentType = $contentType;
    }
}