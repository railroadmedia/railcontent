<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\User;

class UserContentProgressSaved extends Event
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var Content
     */
    public $content;

    /**
     * UserContentProgressSaved constructor.
     *
     * @param User $user
     * @param Content $content
     */
    public function __construct(User $user, Content $content)
    {
        $this->user = $user;
        $this->content = $content;
    }
}