<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Railroad\Railcontent\Contracts\UserInterface;
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
class Content
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
     * @var int
     *
     * @ORM\Column(type="user_id", name="user_id", nullable=true)
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentHierarchy", mappedBy="parent")
     * @ORM\JoinTable(name="railcontent_content_hierarchy",
     *      joinColumns={@ORM\JoinColumn(name="content_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="child_id", referencedColumnName="id", unique=true)}
     *      )
     */
    protected $child;

    /**
     * @ORM\OneToOne(targetEntity="Railroad\Railcontent\Entities\ContentHierarchy",mappedBy="child", cascade={"persist",
     *     "remove"}, fetch="EAGER")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentData", mappedBy="content", cascade={"remove"})
     */
    private $data;

    /**
     * @ORM\Column(type="datetime", name="published_on", nullable=true)
     * @var \DateTime
     */
    protected $publishedOn;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    protected $archivedOn;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\UserContentProgress", mappedBy="content",
     *     indexBy="userId")
     */
    private $userProgress;

    /**
     * @var bool
     */
    private $started = false;

    /**
     * @var bool
     */
    private $completed = false;

//    /**
//     * @var ArrayCollection
//     */
//    private $permissions;

    /**
     * @var int
     */
    private $progressPercent = 0;

    /**
     * @var \DateTime $createdOn
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
        $this->data = new ArrayCollection();
        $this->topic = new ArrayCollection();
        $this->tag = new ArrayCollection();
        $this->key = new ArrayCollection();
        $this->keyPitchType = new ArrayCollection();
        $this->sbtBpm = new ArrayCollection();
        $this->sbtExerciseNumber = new ArrayCollection();
        $this->playlist = new ArrayCollection();
        $this->exercise = new ArrayCollection();
        $this->userProgress = new ArrayCollection();
        //$this->permissions = new ArrayCollection();
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
     * @param string $key
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
     * @param string $key
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
     * @param string $key
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
     * @param string $key
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
     * @param string $key
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
     * @param string $key
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;
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
    public function getUser()
    : ?UserInterface
    {
        return $this->user;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedOn()
    {
        return $this->publishedOn;
    }

    /**
     * Sets publishedOn.
     *
     * @param  \DateTime $publishedOn
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
     * @param  string $createdOn
     * @return $this
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

    /**
     * Sets archivedOn.
     *
     * @param  string $archivedOn
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
     * @return Content
     */
    public function addData(ContentData $data)
    {
        $this->data[] = $data;

        return $this;
    }

    /**
     * @param ContentData $data
     * @return Content
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
        return $this->parent;
    }

    /**
     * @param $parent
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @param ContentInstructor $contentInstructor
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
        return $this->started;
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
        return $this->completed;
    }

    /**
     * @param Boolean $completed
     */
    public function setCompleted(bool $completed)
    {
        $this->completed = $completed;
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
     * @return ArrayCollection
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param ContentPermission $contentPermission
     */
    public function addPermission(ContentPermission $contentPermission)
    {
        if (($contentPermission->getContent()
                    ->getId() == $this->getId()) || ($contentPermission->getContentType() == $this->getType())) {
            $this->permissions[] = $contentPermission;
        }
    }

    /**
     * @param $progressPercent
     */
    public function setProgressPercent($progressPercent)
    {
        $this->progressPercent = $progressPercent;
    }

    /**
     * @param array $contentPermissions
     */
    public function setPermissions(array $contentPermissions)
    {
        $this->permissions = $contentPermissions;

    }
}