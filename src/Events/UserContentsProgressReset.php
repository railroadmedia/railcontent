<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\User;

class UserContentsProgressReset extends Event
{
    public $user;
    public $contents;

    /**
     * UserContentsProgressReset constructor.
     *
     * @param User $user
     * @param array $contents
     */
    public function __construct(User $user, array $contents)
    {
        $this->user = $user;
        $this->contents = $contents;
    }
}