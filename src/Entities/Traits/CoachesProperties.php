<?php

namespace Railroad\Railcontent\Entities\Traits;

use DateTime;
use Doctrine\Search\Mapping\Annotations as MAP;
use Railroad\Railcontent\Entities\User;

trait CoachesProperties
{
    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $bands;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $endorsements;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    protected $forumThreadId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    protected $isActive;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var integer
     */
    protected $isCoach;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var integer
     */
    protected $isCoachOfTheMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var integer
     */
    protected $isFeatured;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var integer
     */
    protected $isHouseCoach;

    /**
     * @var User
     *
     * @ORM\Column(type="user_id", name="associated_user_id", nullable=true)
     */
    protected $associatedUser;

    /**
     * @return string
     */
    public function getBands()
    {
        return $this->bands;
    }

    /**
     * @param string $bands
     */
    public function setBands(string $bands)
    {
        $this->bands = $bands;
    }

    /**
     * @return string
     */
    public function getEndorsements()
    {
        return $this->endorsements;
    }

    /**
     * @param string $endorsements
     */
    public function setEndorsements(string $endorsements)
    {
        $this->endorsements = $endorsements;
    }

    /**
     * @return int
     */
    public function getForumThreadId()
    {
        return $this->forumThreadId;
    }

    /**
     * @param int $forumThreadId
     */
    public function setForumThreadId($forumThreadId)
    {
        $this->forumThreadId = $forumThreadId;
    }

    /**
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return integer
     */
    public function getIsCoach()
    {
        return $this->isCoach;
    }

    /**
     * @param $isCoach
     */
    public function setIsCoach($isCoach)
    {
        $this->isCoach = $isCoach;
    }

    /**
     * @return int
     */
    public function getIsCoachOfTheMonth()
    {
        return $this->isCoachOfTheMonth;
    }

    /**
     * @param $isCoachOfTheMonth
     */
    public function setIsCoachOfTheMonth($isCoachOfTheMonth)
    {
        $this->isCoachOfTheMonth = $isCoachOfTheMonth;
    }

    /**
     * @return integer
     */
    public function getIsHouseCoach()
    {
        return $this->isHouseCoach;
    }

    /**
     * @param $isHouseCoach
     */
    public function setIsHouseCoach($isHouseCoach)
    {
        $this->isHouseCoach = $isHouseCoach;
    }

    /**
     * @return bool
     */
    public function getIsFeatured()
    {
        return $this->isFeatured;
    }

    /**
     * @param $isFeatured
     */
    public function setIsFeatured($isFeatured)
    {
        $this->isFeatured = $isFeatured;
    }

    /**
     * @param User $associatedUser
     */
    public function setAssociatedUser(User $associatedUser)
    {
        $this->associatedUser = $associatedUser;
    }

    /**
     * @return User
     */
    public function getAssociatedUser(): ?User
    {
        return $this->associatedUser;
    }
}