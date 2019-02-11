<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\UserContentProgressRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_user_content_progress")
 *
 */
class UserContentProgress
{
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
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     *
     */
    private $content;

    /**
     * @ORM\Column(type="string", name="state")
     *
     */
    protected $state;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $progressPercent;

    /**
     * @ORM\Column(type="datetime", name="updated_on", nullable=true)
     *
     * @var \DateTime
     */
    protected $updatedOn;

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
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return integer
     */
    public function getProgressPercent()
    {
        return $this->progressPercent;
    }

    /**
     * @param integer $progressPercent
     */
    public function setProgressPercent($progressPercent)
    {
        $this->progressPercent = $progressPercent;
    }

    /**
     * @return string
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * @param string $value
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}