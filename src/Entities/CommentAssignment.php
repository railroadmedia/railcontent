<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use Railroad\Railcontent\Contracts\UserInterface;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\CommentAssignmentRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_comment_assignment")
 *
 */
class CommentAssignment
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @var int
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
     * @var \DateTime $assignedOn
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime",  name="assigned_on")
     */
    protected $assignedOn;

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
        $comment->addAssignedToUser($this);

        $this->comment = $comment;
    }

    /**
     * @param UserInterface|null $user
     */
    public function setUser(?UserInterface $user)
    {
        $this->user = $user;
    }


    /**
     * @return UserInterface|null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * Returns assignedOn.
     *
     * @return string
     */
    public function getAssignedOn()
    {
        return $this->assignedOn;
    }

    /**
     * Sets assignedOn.
     *
     * @param  string $assignedOn
     * @return $this
     */
    public function setAssignedOn($assignedOn)
    {
        $this->assignedOn = $assignedOn;
    }
}