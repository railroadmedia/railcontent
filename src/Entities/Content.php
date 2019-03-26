<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Railroad\Railcontent\Contracts\UserInterface;
use Railroad\Railcontent\Entities\Traits\ContentFieldsAssociations;
use Railroad\Railcontent\Entities\Traits\ContentFieldsProperties;
use Railroad\Railcontent\Entities\Traits\DecoratedFields;
use Doctrine\Common\Persistence\Proxy;

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
        $this->playlist = new ArrayCollection();
        $this->exercise = new ArrayCollection();
        $this->userProgress = new ArrayCollection();
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
     * @return int
     */
    public function getProgressPercent()
    {
        return $this->progressPercent;
    }

    /**
     * @param array $contentPermissions
     */
    public function setPermissions(array $contentPermissions)
    {
        $this->permissions = $contentPermissions;

    }

    public function __get($name)
    {
        $_classMethods = get_class_methods($this);
        $method = 'get' . ucfirst($name);

        if (in_array($method, $_classMethods)) {
            return $this->$method();
        }
    }

    public function fetch($dotNotationString, $default = '')
    {
        return $this->dot()[$dotNotationString] ?? $default;
    }

    public function dot()
    {
        $arr = get_object_vars($this);

        foreach ($arr as $key => $value) {
            if (($key != 'vimeoVideo')) {
                if ($value instanceof PersistentCollection && !($value->isEmpty())) {
                    unset($arr[$key]);
                    foreach ($value as $dataIndex => $elem) {
                        if ($elem instanceof ContentData) {
                            if ($elem->getPosition() == 1) {
                                $datumDots['data.' . $elem->getKey()] = $elem->getValue();
                                $datumDots['data.*.' . $elem->getKey()] = $elem;
                            }

                            $datumDots['data.' . $elem->getKey() . '.' . $elem->getPosition()] = $elem->getValue();
                            $datumDots['data.*.' . $elem->getKey() . '.' . $elem->getPosition()] = $elem;

                            foreach ($elem as $datumColumnName => $datumColumnValue) {
                                if ($elem->getPosition() == 1) {
                                    $datumDots['data.' . $elem->getKey() . '.' . $datumColumnName] = $datumColumnValue;
                                }

                                'data.' .
                                $datumDots[$elem->getKey() . '.' . $elem->getPosition() . '.' . $datumColumnName] =
                                    $datumColumnValue;
                            }

                            $arr = array_merge($arr, $datumDots);
                        } elseif (!($elem instanceof ContentHierarchy) && !($elem instanceof UserContentProgress)) {
                            //dd($key);
                            //                            if ($elem->getPosition()== 1) {
                            //                                $datumDots['fields.'.$elem->getKey()] = $elem->getValue();
                            //                                $datumDots['fields.*.' . $elem->getKey()] = $elem;
                            //                            }
                            //
                            //                            $datumDots['fields.'.$elem->getKey() . '.' . $elem->getPosition()] = $elem->getValue();
                            //                            $datumDots['fields.*.' . $elem->getKey() . '.' . $elem->getPosition()] = $elem;
                            //                            //  $fieldDots['*.' . $elem->getKey() . '.' . 'value'][] = $elem->getValue();
                            //
                            //                            foreach ($elem as $datumColumnName => $datumColumnValue) {
                            //                                if ($elem->getPosition() == 1) {
                            //                                    $datumDots['fields.' . $elem->getKey() . '.' . $datumColumnName] = $datumColumnValue;
                            //                                }
                            //
                            //                                'fields.'.$datumDots[$elem->getKey() . '.' . $elem->getPosition() . '.' . $datumColumnName] =
                            //                                    $datumColumnValue;
                            //                            }
                            //
                            //                            //$arr[$key] = $datumDots;
                            //                            $arr = array_merge($arr,$datumDots);
                            // $arr = array_merge($arr,$elem->toArray());
                            // $arr[$key] = $elem->toArray();
                        }
                    }
                } elseif ($value instanceof ContentInstructor) {
                    $instructor = $value->getInstructor();

                    $fieldDots['*fields.instructor'] = [$instructor];
                    $fieldDots['fields.instructor.' . $value->getPosition()] = $value->getInstructor();
                    $fieldDots['fields.instructor.' . $value->getPosition() . '.id'] = $instructor->getId();
                    $fieldDots['fields.instructor.' . $value->getPosition() . '.name'] = $instructor->getName();
                    $fieldDots['fields.instructor.' . $value->getPosition() . '.slug'] = $instructor->getSlug();
                    $fieldDots['fields.instructor.' . $value->getPosition() . '.brand'] = $instructor->getBrand();
                    $fieldDots['fields.instructor.' . $value->getPosition() . '.type'] = $instructor->getType();
                    $fieldDots['fields.instructor.' . $value->getPosition() . '.status'] = $instructor->getStatus();

                    $data = $instructor->getData();

                    $fieldDots['fields.instructor.' . $value->getPosition() . '.data'] = $data;

                    foreach ($data as $dataElement) {
                        $fieldDots['fields.instructor.' . $value->getPosition() . '.data.' . $dataElement->getKey()] =
                            $dataElement->getValue();
                    }
                    $arr = array_merge($arr, $fieldDots);
                }

            }
        }

        return $arr;
    }
}