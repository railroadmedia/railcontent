<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class CommentCreated extends Event
{
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
     * @param integer $commentId
     * @param $userId
     * @param integer $parentId
     * @param string $commentText
     */
    public function __construct($commentId, $userId, $parentId, $commentText)
    {
        $this->commentId = $commentId;
        $this->userId = $userId;
        $this->parentId = $parentId;
        $this->commentText = $commentText;
    }
}