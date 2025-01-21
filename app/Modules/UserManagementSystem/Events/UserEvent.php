<?php

namespace Modules\UserManagementSystem\Events;

class UserEvent
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $eventType;

    /**
     * Create a new event instance.
     *
     * @param $id
     * @param $eventType
     */
    public function __construct($id, $eventType)
    {
        $this->id = $id;
        $this->eventType = $eventType;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEventType(): string
    {
        return $this->eventType;
    }
}
