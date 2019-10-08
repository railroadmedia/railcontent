<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\User;

class CommentUnLiked extends Event
{
    /**
     * @var Comment
     */
    public $comment;

    /**
     * @var User
     */
    public $user;

    /**
     * @var integer
     */
    public $commentId;
    /**
     * @var
     */
    public $userId;

    /**
     * CommentUnLiked constructor.
     *
     * @param Comment $comment
     * @param User $user
     */
    public function __construct(Comment $comment, User $user)
    {
        $this->comment = $comment;
        $this->user = $user;

        $this->commentId = $comment->getId();
        $this->userId = $user->getId();
    }
}