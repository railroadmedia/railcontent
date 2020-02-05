<?php

namespace Railroad\Railcontent\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\UserContentProgressRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_user_content_progress",
 *     indexes={
 *         @ORM\Index(name="railcontent_user_content_progress_content_id_index", columns={"content_id"}),
 *         @ORM\Index(name="railcontent_user_content_progress_user_id_index", columns={"user_id"}),
 *         @ORM\Index(name="railcontent_user_content_progress_state_index", columns={"state"}),
 *         @ORM\Index(name="railcontent_user_content_progress_state_index", columns={"progress_percent"}),
 *         @ORM\Index(name="railcontent_user_content_progress_updated_on_index", columns={"updated_on"}),
 *         @ORM\Index(name="c_s", columns={"content_id","state"}),
 *         @ORM\Index(name="railcontent_user_content_progress_higher_key_progress_index", columns={"higher_key_progress"}),
 *         @ORM\Index(name="c_u_s", columns={"content_id","user_id","state"}),
 *     }
 * )
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
     * @ORM\Column(type="string", name="higher_key_progress")
     *
     */
    protected $higherKeyProgress;

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

    /**
     * @return string
     */
    public function getHigherKeyProgress()
    {
        return $this->higherKeyProgress;
    }

    /**
     * @param string $higherKeyProgress
     */
    public function setHigherKeyProgress($higherKeyProgress)
    {
        $this->higherKeyProgress = $higherKeyProgress;
    }
}