<?php

namespace Railroad\Railcontent\Events;


use Illuminate\Support\Facades\Event;

class CommentDeleted extends Event
{
    /**
     * @var int
     */
    public $commentId;

    public function __construct($commentId)
    {
        $this->commentId = $commentId;
    }
}