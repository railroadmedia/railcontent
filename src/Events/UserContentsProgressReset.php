<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\User;
use Railroad\Railcontent\Services\ResponseService;

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
        if(ResponseService::$oldResponseStructure == true){
            $this->userId = $user->getId();
            $this->contents = $contents->getId();
        } else {
            $this->user = $user;
            $this->contents = $contents;
        }
    }
}