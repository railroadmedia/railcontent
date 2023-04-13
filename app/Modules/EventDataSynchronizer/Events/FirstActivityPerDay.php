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
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getBrands()
    {
        return $this->brands;
    }

    /**
     * @return string
     */
    public function getDateTimeString()
    {
        return $this->dateTimeString;
    }
}
