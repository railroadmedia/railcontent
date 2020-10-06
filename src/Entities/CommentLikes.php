<?php

namespace Railroad\Railcontent\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Railroad\Railcontent\Entities\Traits\DecoratedFields;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\CommentLikeRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_comment_likes",
 *     indexes={
 *         @ORM\Index(name="railcontent_comment_likes_comment_id_index", columns={"comment_id"}),
 *         @ORM\Index(name="railcontent_comment_likes_user_id_index", columns={"user_id"}),
 *         @ORM\Index(name="railcontent_comment_likes_created_on_index", columns={"created_on"})
 *     }
 * )
 *
 */
class CommentLikes
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
     * @ORM\Column(type="user_id", name="user_id", nullable=true)
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Comment")
     * @ORM\JoinColumn(name="comment_id", referencedColumnName="id")
     *
     */
    private $comment;

    /**
     * @var DateTime $createdOn
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
     * @param Comment $comment
     */
    public function setComment(Comment $comment)
    {
        $comment->addLikes($this);

        $this->comment = $comment;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
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