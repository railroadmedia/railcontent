<?php

namespace App\Modules\EventDataSynchronizer\Events;

class LiveStreamEventAttended
{
    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $contentId;

    /**
     * @var string
     */
    private $dateTimeString;

    public function __construct(int $userId, int $contentId, string $dateTimeString)
    {
        $this->userId = $userId;
        $this->contentId = $contentId;
        $this->dateTimeString = $dateTimeString;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getContentId(): int
    {
        return $this->contentId;
    }

    public function getDateTimeString(): string
    {
        return $this->dateTimeString;
    }
}
