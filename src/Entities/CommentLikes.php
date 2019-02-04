<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\CommentLikeRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_comment_likes")
 *
 */
class CommentLikes
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
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Comment")
     * @ORM\JoinColumn(name="comment_id", referencedColumnName="id")
     *
     */
    private $comment;

    /**
     * @var \DateTime $createdOn
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime",  name="created_on")
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
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $content
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $content
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Returns createdOn.
     *
     * @return string
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Sets createdOn.
     *
     * @param  string $createdOn
     * @return $this
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }
}