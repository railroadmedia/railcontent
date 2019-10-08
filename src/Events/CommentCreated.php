<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\User;

class CommentCreated extends Event
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
     * @var Content
     */
    public $content;

    /**
     * @var integer
     */
    public $commentId;
    /**
     * @var
     */
    public $userId;
    /**
     * @var integer
     */
    public $parentId;
    /**
     * @var string
     */
    public $commentText;

    /**
     * CommentCreated constructor.
     *
     * @param Comment $comment
     * @param Content $content
     * @param User $user
     */
    public function __construct(Comment $comment, Content $content, User $user)
    {
        $this->comment = $comment;
        $this->user = $user;
        $this->content = $content;
        $this->commentId = $comment->getId();
        $this->userId = $user->getId();
        $this->parentId =
            ($comment->getParent()) ?
                $comment->getParent()
                    ->getId() : null;
        $this->commentText = $comment->getComment();
    }
}