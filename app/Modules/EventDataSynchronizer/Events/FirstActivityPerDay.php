<?php

namespace App\Modules\EventDataSynchronizer\Events;

class FirstActivityPerDay
{
    /**
     * @var integer
     */
    private $userId;

    /**
     * @var string
     */
    private $brands;

    /**
     * @var string
     */
    private $dateTimeString;

    /**
     * @param $userId
     * @param $brands
     * @param $dateTimeString
     */
    public function __construct($userId, $brands, $dateTimeString)
    {
        $this->userId = $userId;
        $this->brands = $brands;
        $this->dateTimeString = $dateTimeString;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getBrands(): string
    {
        return $this->brands;
    }

    public function getDateTimeString(): string
    {
        return $this->dateTimeString;
    }
}
