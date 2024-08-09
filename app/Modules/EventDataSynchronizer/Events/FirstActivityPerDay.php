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

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getBrands(): string
    {
        return $this->brands;
    }

    /**
     * @return string
     */
    public function getDateTimeString(): string
    {
        return $this->dateTimeString;
    }
}
