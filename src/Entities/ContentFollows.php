<?php

namespace Railroad\Railcontent\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Railroad\Railcontent\Entities\Traits\DecoratedFields;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\ContentFollowsRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_content_follows",
 *     indexes={
 *         @ORM\Index(name="railcontent_content_follows_content_id_index", columns={"content_id"}),
 *         @ORM\Index(name="railcontent_content_follows_user_id_index", columns={"user_id"}),
 *         @ORM\Index(name="railcontent_content_follows_created_on_index", columns={"created_on"}),
 *     }
 * )
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 *
 */
class ContentFollows
{
    use DecoratedFields;

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
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     *
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", name="created_on", nullable=true)
     *
     * @var DateTime
     */
    protected $createdOn;

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
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
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

        $content->addFollows($this);
    }
}