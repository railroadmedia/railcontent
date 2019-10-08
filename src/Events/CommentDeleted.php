<?php

namespace Railroad\Railcontent\Events;


use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\Comment;

class CommentDeleted extends Event
{
    /**
     * @var Comment
     */
    public $comment;

    /**
     * @var int
     */
    public $commentId;
    /**
     * CommentDeleted constructor.
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        $this->commentId = $comment->getId();
    }
}