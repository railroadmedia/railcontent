<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\UserPermissionsRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_user_permissions")
 *
 */
class UserPermission
{
    use TimestampableEntity;
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $userId;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Permission")
     * @ORM\JoinColumn(name="permission_id", referencedColumnName="id")
     *
     */
    private $permission;

    /**
     * @ORM\Column(type="datetime", name="start_date")
     *
     */
    protected $startDate;

    /**
     * @ORM\Column(type="datetime", name="expiration_date", nullable=true)
     *
     * @var \DateTime
     */
    protected $expirationDate;

    /**
     * @return int
     */
    public function getId()
    : int
    {
        return $this->id;
    }

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $key
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param string $value
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param $expirationDate
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
    }

    /**
     * @return mixed
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * @param mixed $content
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;
    }
}