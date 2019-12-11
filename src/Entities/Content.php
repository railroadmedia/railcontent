<?php

namespace Railroad\Railcontent\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Railroad\Railcontent\Entities\Traits\ContentFieldsAssociations;
use Railroad\Railcontent\Entities\Traits\ContentFieldsProperties;
use Railroad\Railcontent\Entities\Traits\DecoratedFields;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\ContentRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_content")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 *
 */
class Content extends ArrayExpressible
{
    use ContentFieldsProperties;
    use ContentFieldsAssociations;
    use DecoratedFields;

    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="slug")
     * @var string
     */
    protected $slug;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $type;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $sort = 0;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $status;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $totalXp;

    /**
     * @ORM\Column(type="text")
     * @var text
     */
    protected $brand;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $language;

    /**
     * @var User
     *
     * @ORM\Column(type="user_id", name="user_id", nullable=true)
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentHierarchy", mappedBy="parent")
     */
    private $child;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentHierarchy",mappedBy="child", cascade={"persist",
     *     "remove"})
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentData", mappedBy="content", cascade={"remove"})
     * @ORM\JoinColumn(name="id", referencedColumnName="content_id")
     */
    protected $data;

    /**
     * @ORM\Column(type="datetime", name="published_on", nullable=true)
     * @var DateTime
     */
    protected $publishedOn;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTime
     */
    protected $archivedOn;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\UserContentProgress", mappedBy="content",
     *     indexBy="user")
     */
    private $userProgress;

    /**
     * @var bool
     */
    protected $started = false;

    /**
     * @var bool
     */
    protected $completed = false;

    /**
     * @var int
     */
    protected $progressPercent = 0;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentLikes", mappedBy="content")
     */
    private $likes;

    /**
     * @var DateTime $createdOn
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $createdOn;


    /**
     * Content constructor.
     */
    public function __construct()
    {
        $this->child = new ArrayCollection();
        $this->parent = new ArrayCollection();
        $this->data = new ArrayCollection();
        $this->topic = new ArrayCollection();
        $this->tag = new ArrayCollection();
        $this->key = new ArrayCollection();
        $this->keyPitchType = new ArrayCollection();
        $this->playlist = new ArrayCollection();
        $this->exercise = new ArrayCollection();
        $this->userProgress = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug()
    : string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getType()
    : string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param string $sort
     */
    public function setSort(string $sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return string
     */
    public function getStatus()
    : string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return text
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return text
     */
    public function getLanguage()

    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User|null
     */
    public function getUser()
    : ?User
    {
        return $this->user;
    }

    /**
     * @return DateTime
     */
    public function getPublishedOn()
    {
        return $this->publishedOn;
    }

    /**
     * Sets publishedOn.
     *
     * @param DateTime $publishedOn
     * @return $this
     */
    public function setPublishedOn($publishedOn)
    {
        $this->publishedOn = $publishedOn;

        return $this;
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
     * @param string $createdOn
     * @return $this
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

    /**
     * Sets archivedOn.
     *
     * @param string $archivedOn
     * @return $this
     */
    public function setArchivedOn($archivedOn)
    {
        $this->archivedOn = $archivedOn;
    }

    /**
     * Returns archivedOn.
     *
     * @return string
     */
    public function getArchivedOn()
    {
        return $this->archivedOn;
    }

    /**
     * @param ContentData $data
     */
    public function addData(ContentData $data)
    {
        $this->data[] = $data;
    }

    /**
     * @param $child
     */
    public function addChild($child)
    {
        $this->child[] = $child;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        if (($this->parent) && (!$this->parent->isEmpty())) {
            $parent = $this->parent->filter(
                function (ContentHierarchy $hierarchy) {
                    return $hierarchy->getParent()
                            ->getType() != 'user-playlist';
                }
            );

            return $parent->first();
        }

        return null;
    }

    /**
     * @param $parent
     * @return $this
     */
    public function setParent($parent)
    {
        if ($parent) {
            $this->parent[] = $parent;
        }

        return $this;
    }

    /**
     * @param ContentHierarchy $parent
     */
    public function removeParent(ContentHierarchy $parent)
    {
        // If does not exist in the collection, then we don't need to do anything
        if (!$this->parent->contains($parent)) {
            return;
        }

        $this->parent->removeElement($parent);
    }

    /**
     * @return ArrayCollection
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * @return bool
     */
    public function isStarted()
    {
        $userProgress = $this->userProgress[auth()->id()];
        if (!$userProgress) {
            return false;
        }
        return ($userProgress->getState() == 'started') ? true : false;
    }

    /**
     * @param Boolean $started
     */
    public function setStarted(bool $started)
    {
        $this->started = $started;
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        $userProgress = $this->userProgress[auth()->id()];
        if (!$userProgress) {
            return false;
        }
        return ($userProgress->getState() == 'completed') ? true : false;

        //return $this->completed;
    }

    /**
     * @param Boolean $completed
     */
    public function setCompleted(bool $completed)
    {
        $this->completed = $completed;
    }

    /**
     * @return bool
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * @param $userId
     * @return array
     */
    public function getUserProgress($userId)
    {
        if (!isset($this->userProgress[$userId])) {
            return [];
        }
        return $this->userProgress[$userId];
    }

    /**
     * @param $userId
     * @return array
     */
    public function getUserProgresses()
    {
        return $this->userProgress->toArray();
    }

    /**
     * @param $userProgress
     */
    public function addUserProgress($userProgress)
    {
        if ($userProgress->getUser()) {
            $this->userProgress[$userProgress->getUser()
                ->getId()] = $userProgress;

            $this->setStarted($userProgress->getState() == 'started' ? true : false);
            $this->setCompleted($userProgress->getState() == 'completed' ? true : false);
            $this->setProgressPercent($userProgress->getProgressPercent());
        }
    }


    /**
     * @param $progressPercent
     */
    public function setProgressPercent($progressPercent)
    {
        $this->progressPercent = $progressPercent;

        if ($progressPercent == 100) {
            $this->setCompleted(true);
        }
    }

    /**
     * @return int
     */
    public function getProgressPercent()
    {
        $userProgress = $this->userProgress[auth()->id()];
        if (!$userProgress) {
            return 0;
        }
        return $userProgress->getProgressPercent();
    }

    /**
     * @param ContentLikes $likes
     */
    public function addLikes(ContentLikes $likes)
    {
        $this->likes[] = $likes;
    }

    /**
     * @return ArrayCollection
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @return text
     */
    public function getTotalXp()
    {
        return $this->totalXp;
    }

    /**
     * @param string $brand
     */
    public function setTotalXp(?string $totalXP)
    {
        $this->totalXp = $totalXP;
    }
}