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

    /**
     * @param  integer  $userId
     * @param  integer  $contentId
     * @param  string  $dateTimeString
     */
    public function __construct(int $userId, int $contentId, string $dateTimeString)
    {
        $this->userId = $userId;
        $this->contentId = $contentId;
        $this->dateTimeString = $dateTimeString;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getContentId(): int
    {
        return $this->contentId;
    }

    /**
     * @return string
     */
    public function getDateTimeString(): string
    {
        return $this->dateTimeString;
    }
}
