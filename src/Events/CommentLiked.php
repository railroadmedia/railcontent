<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class CommentLiked extends Event
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
     * CommentCreated constructor.
     *
     * @param integer $commentId
     * @param $userId
     */
    public function __construct($commentId, $userId)
    {
        $this->commentId = $commentId;
        $this->userId = $userId;
    }
}