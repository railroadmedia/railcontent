<?php

namespace Railroad\Railcontent\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\UserContentProgressRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_user_content_progress")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
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
     * @var User
     *
     * @ORM\Column(type="user_id", name="user_id", unique=true)
     */
    protected $user;

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
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content", inversedBy="userProgress")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     *
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", name="updated_on", nullable=true)
     *
     * @var DateTime
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
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
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
     * @param $updatedOn
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
     * @param Content $content
     */
    public function setContent(Content $content)
    {
        $this->content = $content;

        $content->addUserProgress($this);
    }
}