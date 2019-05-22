<?php

namespace Railroad\Railcontent\Listeners;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Services\UserContentProgressService;

class UserContentProgressEventListener extends Event
{
    /**
     * @var UserContentProgressService
     */
    private $userContentProgressService;

    /**
     * UserContentProgressEventListener constructor.
     *
     * @param UserContentProgressService $userContentProgressService
     */
    public function __construct(UserContentProgressService $userContentProgressService)
    {
        $this->userContentProgressService = $userContentProgressService;
    }

    /**
     * @param UserContentProgressSaved $event
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handle(UserContentProgressSaved $event)
    {
        $this->userContentProgressService->bubbleProgress($event->user, $event->content);
    }
}