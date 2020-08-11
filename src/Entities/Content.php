<?php

namespace Railroad\Railcontent\Entities;

use Carbon\Carbon;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Railroad\Railcontent\Entities\Traits\ContentFieldsAssociations;
use Railroad\Railcontent\Entities\Traits\ContentFieldsProperties;
use Railroad\Railcontent\Entities\Traits\DecoratedFields;
use Doctrine\Search\Mapping\Annotations as MAP;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\ContentRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_content",
 *     indexes={
 *         @ORM\Index(name="railcontent_content_slug_index", columns={"slug"}),
 *         @ORM\Index(name="railcontent_content_language_index", columns={"language"}),
 *         @ORM\Index(name="railcontent_content_user_id_index", columns={"user_id"}),
 *         @ORM\Index(name="railcontent_content_archived_on_index", columns={"archived_on"}),
 *         @ORM\Index(name="railcontent_content_sort_index", columns={"sort"}),
 *         @ORM\Index(name="t_s_b", columns={"type","status","brand"}),
 *         @ORM\Index(name="railcontent_content_total_xp_index", columns={"total_xp"}),
 *         @ORM\Index(name="railcontent_content_difficulty_index", columns={"difficulty"}),
 *         @ORM\Index(name="railcontent_content_home_staff_pick_rating_index", columns={"home_staff_pick_rating"}),
 *         @ORM\Index(name="railcontent_content_legacy_id_index", columns={"legacy_id"}),
 *         @ORM\Index(name="railcontent_content_legacy_wordpress_post_id_index", columns={"legacy_wordpress_post_id"}),
 *         @ORM\Index(name="railcontent_content_qna_video_index", columns={"qna_video"}),
 *         @ORM\Index(name="railcontent_content_style_index", columns={"style"}),
 *         @ORM\Index(name="railcontent_content_title_index", columns={"title"}),
 *         @ORM\Index(name="railcontent_content_video_index", columns={"video"}),
 *         @ORM\Index(name="railcontent_content_xp_index", columns={"xp"}),
 *         @ORM\Index(name="railcontent_content_album_index", columns={"album"}),
 *         @ORM\Index(name="railcontent_content_artist_index", columns={"artist"}),
 *         @ORM\Index(name="railcontent_content_bpm_index", columns={"bpm"}),
 *         @ORM\Index(name="railcontent_content_cd_tracks_index", columns={"cd_tracks"}),
 *         @ORM\Index(name="railcontent_content_chord_or_scale_index", columns={"chord_or_scale"}),
 *         @ORM\Index(name="railcontent_content_difficulty_range_index", columns={"difficulty_range"}),
 *         @ORM\Index(name="railcontent_content_episode_number_index", columns={"episode_number"}),
 *         @ORM\Index(name="railcontent_content_exercise_book_pages_index", columns={"exercise_book_pages"}),
 *         @ORM\Index(name="railcontent_content_includes_song_index", columns={"includes_song"}),
 *         @ORM\Index(name="railcontent_content_instructors_index", columns={"instructors"}),
 *         @ORM\Index(name="railcontent_content_live_event_start_time_index", columns={"live_event_start_time"}),
 *         @ORM\Index(name="railcontent_content_live_event_end_time_index", columns={"live_event_end_time"}),
 *         @ORM\Index(name="railcontent_content_live_event_youtube_id_index", columns={"live_event_youtube_id"}),
 *         @ORM\Index(name="railcontent_content_live_stream_feed_type_index", columns={"live_stream_feed_type"}),
 *         @ORM\Index(name="railcontent_content_name_index", columns={"name"}),
 *         @ORM\Index(name="railcontent_content_transcriber_name_index", columns={"transcriber_name"}),
 *         @ORM\Index(name="railcontent_content_week_index", columns={"week"}),
 *         @ORM\Index(name="railcontent_content_avatar_url_index", columns={"avatar_url"}),
 *         @ORM\Index(name="railcontent_content_length_in_seconds_index", columns={"length_in_seconds"}),
 *         @ORM\Index(name="railcontent_content_soundslice_slug_index", columns={"soundslice_slug"}),
 *         @ORM\Index(name="railcontent_content_staff_pick_rating_index", columns={"staff_pick_rating"}),
 *         @ORM\Index(name="railcontent_content_student_id_index", columns={"student_id"}),
 *         @ORM\Index(name="railcontent_content_vimeo_video_id_index", columns={"vimeo_video_id"}),
 *         @ORM\Index(name="railcontent_content_youtube_video_id_index", columns={"youtube_video_id"})
 *     }
 * )
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 *
 *
 */
class Content extends ArrayExpressible
{
    use ContentFieldsProperties;
    use ContentFieldsAssociations;
    use DecoratedFields;

    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="slug")
     *
     * @var string
     */
    protected $slug;

    /**
     * @ORM\Column(type="string")
     *
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
     *
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
     *
     * @var text
     */
    protected $brand;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $language;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    protected $showInNewFeed;

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
     * @ORM\ManyToMany(targetEntity="Railroad\Railcontent\Entities\Content", inversedBy="child")
     * @ORM\JoinTable(name="railcontent_content_hierarchy",
     *      joinColumns={@ORM\JoinColumn(name="parent_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="child_id", referencedColumnName="id")}
     *      )
     */
    private $childrenContent;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentHierarchy",mappedBy="child", cascade={"persist",
     *     "remove"})
     */
    private $parent;

    /**
     * @ORM\ManyToMany(targetEntity="Railroad\Railcontent\Entities\Content", inversedBy="parent")
     * @ORM\JoinTable(name="railcontent_content_hierarchy",
     *      joinColumns={@ORM\JoinColumn(name="child_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="parent_id", referencedColumnName="id")}
     *      )
     */
    private $parentContent;

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
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\UserContentProgress", mappedBy="content")
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
     * @var string
     */
    protected $progressState = null;

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
        $this->instructor = new ArrayCollection();
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
     * @return bool
     */
    public function getShowInNewFeed()

    {
        return $this->showInNewFeed;
    }

    /**
     * @param bool $showInNewFeed
     */
    public function setShowInNewFeed(bool $showInNewFeed)
    {
        $this->showInNewFeed = $showInNewFeed;
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
        return $this->parent;
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
        return ($this->getUserProgress()) ?
            ($this->getUserProgress()
                ->getState() == 'started' ? true : false) : false;
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
    public function getStarted()
    {
        return ($this->getUserProgress()) ?
            ($this->getUserProgress()
                ->getState() == 'started' ? true : false) : false;
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        return ($this->getUserProgress()) ?
            ($this->getUserProgress()
                ->getState() == 'completed' ? true : false) : false;
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
    public function getUserProgress()
    {
        if (!isset($this->userProgress[auth()->id()])) {
            return [];
        }

        return $this->userProgress[auth()->id()];
    }

    /**
     * @param $userId
     * @return array
     */
    public function getUserProgresses()
    {
        return $this->userProgress;
    }

    public function setUserProgresses($userProgress)
    {
        $this->userProgress = $userProgress;
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
        return ($this->getUserProgress()) ?
            $this->getUserProgress()
                ->getProgressPercent() : 0;
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

    /**
     * @return mixed
     */
    public function getChildrenContent()
    {
        return $this->childrenContent;
    }

    /**
     * @return mixed
     */
    public function getParentContent()
    {
        return ($this->parentContent) ? $this->parentContent->first() : null;
    }

    /**
     * @return |null
     */
    public function getProgressState()
    {
        if ($this->getProgressPercent() > 0) {

            $userProgress = $this->getUserProgress();
            if (!$userProgress) {
                return null;
            }
            return $userProgress->getState();
        }
        return null;
    }

    /**
     * @return array
     */
    public function getElasticData()
    {
        $topics = [];
        foreach ($this->getTopic() as $contentTopic) {
            $topics[] = $contentTopic->getTopic();
        }

        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'difficulty' => $this->getDifficulty(),
            'status' => $this->getStatus(),
            'brand' => $this->getBrand(),
            'style' => $this->getStyle(),
            'content_type' => $this->getType(),
            'published_on' => $this->getPublishedOn(),
            'topic' => $topics,
            'bpm' => $this->getBpm(),
            'staff_pick_rating' => $this->getStaffPickRating(),
        ];
    }
}