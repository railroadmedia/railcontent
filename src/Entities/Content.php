<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\ContentRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="railcontent_content")
 *
 */
class Content
{
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
     * @ORM\Column(type="integer", nullable=true)
     * @var integer
     */
    protected $userId;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $difficulty;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $homeStaffPickRating;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    protected $legacyId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    protected $legacyWordpressPostId;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $qnaVideo;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $style;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $video;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    protected $xp;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $album;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $artist;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    protected $bpm;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $cdTracks;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $chordOrScale;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $difficultyRange;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    protected $episodeNumber;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $exerciseBookPages;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    protected $fastBpm;

    /**
     * @ORM\Column(type="boolean"), nullable=true
     * @var boolean
     */
    protected $includesSong = false;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $instructors;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    protected $liveEventStartTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    protected $liveEventEndTime;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $liveEventYoutubeId;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $liveStreamFeedType;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $released;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $slowBpm;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $totalXp;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $transcriberName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    protected $week;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $avatarUrl;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    protected $lengthInSeconds;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $soundsliceSlug;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    protected $staffPickRating;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    protected $studentId;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $vimeoVideoId;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $youtubeVideoId;

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
     * @var \DateTime $createdOn
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $createdOn;

    /**
     * @ORM\OneToMany(targetEntity="ContentExercise", mappedBy="content")
     * @ORM\JoinTable(name="railcontent_content_exercise",
     *      joinColumns={@ORM\JoinColumn(name="content_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="exercise_id", referencedColumnName="id", unique=true)}
     *      )
     */
    protected $exercises;

    /**
     * @ORM\OneToMany(targetEntity="Content",mappedBy="content")
     */
    protected $instructor;

    /**
     * @ORM\OneToMany(targetEntity="ContentVimeoVideo", mappedBy="content")
     */
    protected $vimeoVideo;

    /**
     * @ORM\OneToMany(targetEntity="ContentHierarchy", mappedBy="parent")
     * @ORM\JoinTable(name="railcontent_content_hierarchy",
     *      joinColumns={@ORM\JoinColumn(name="content_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="child_id", referencedColumnName="id", unique=true)}
     *      )
     */
    protected $child;

    /**
     * @ORM\OneToMany(targetEntity="ContentHierarchy", mappedBy="child")
     * @ORM\JoinTable(name="railcontent_content_hierarchy",
     *      joinColumns={@ORM\JoinColumn(name="content_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="parent_id", referencedColumnName="id", unique=true)}
     *      )
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentData", mappedBy="content")
     */
    private $data;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentTopic", mappedBy="content")
     */
    private $topic;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentTag", mappedBy="content")
     */
    private $tag;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentKey", mappedBy="content")
     */
    private $key;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentKeyPitchType", mappedBy="content")
     */
    private $keyPitchType;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentSbtBpm", mappedBy="content")
     */
    private $sbtBpm;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentSbtExerciseNumber", mappedBy="content")
     */
    private $sbtExerciseNumber;

    /**
     * @ORM\OneToMany(targetEntity="Railroad\Railcontent\Entities\ContentPlaylist", mappedBy="content")
     */
    private $playlist;

    public function __construct()
    {
        $this->data = new ArrayCollection();
        $this->instructor = new ArrayCollection();
        $this->topic = new ArrayCollection();
        $this->tag = new ArrayCollection();
        $this->key = new ArrayCollection();
        $this->keyPitchType = new ArrayCollection();
        $this->sbtBpm = new ArrayCollection();
        $this->sbtExerciseNumber = new ArrayCollection();
        $this->playlist = new ArrayCollection();
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
    : void {
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
    : void {
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
    : void {
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
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param integer $userId
     */
    public function setUserId($userId)
    : void {
        $this->userId = $userId;
    }

    /**
     * @return text
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @param string $difficulty
     */
    public function setDifficulty(string $difficulty)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * @return text
     */
    public function getHomeStaffPickRating()
    {
        return $this->homeStaffPickRating;
    }

    /**
     * @param string $homeStaffPickRating
     */
    public function setHomeStaffPickRating(string $homeStaffPickRating)
    {
        $this->homeStaffPickRating = $homeStaffPickRating;
    }

    /**
     * @return int
     */
    public function getLegacyId()
    {
        return $this->legacyId;
    }

    /**
     * @param int $legacyId
     */
    public function setLegacyId($legacyId)
    {
        $this->legacyId = $legacyId;
    }

    /**
     * @return text
     */
    public function getLegacyWordpressPostId()
    {
        return $this->legacyWordpressPostId;
    }

    /**
     * @param string $legacyWordpressId
     */
    public function setLegacyWordpressPostId($legacyWordpressPostId)
    {
        $this->legacyWordpressPostId = $legacyWordpressPostId;
    }

    /**
     * @return text
     */
    public function getQnaVideo()
    {
        return $this->qnaVideo;
    }

    /**
     * @param string $key
     */
    public function setQnaVideo($qnaVideo)
    {
        $this->qnaVideo = $qnaVideo;
    }

    /**
     * @return text
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param string $key
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }

    /**
     * @return text
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $key
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return text
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param string $key
     */
    public function setVideo(string $video)
    {
        $this->video = $video;
    }

    /**
     * @return text
     */
    public function getXp()
    {
        return $this->xp;
    }

    /**
     * @param string $key
     */
    public function setXp($xp)
    {
        $this->xp = $xp;
    }

    /**
     * @return text
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * @param string $video
     */
    public function setAlbum($album)
    {
        $this->album = $album;
    }

    /**
     * @return text
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param string $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    /**
     * @return int
     */
    public function getBpm()
    {
        return $this->bpm;
    }

    /**
     * @param int $bpm
     */
    public function setBpm($bpm)
    {
        $this->bpm = $bpm;
    }

    /**
     * @return text
     */
    public function getCdTracks()
    {
        return $this->cdTracks;
    }

    /**
     * @param string $key
     */
    public function setCdTracks($cdTracks)
    {
        $this->cdTracks = $cdTracks;
    }

    /**
     * @return text
     */
    public function getChordOrScale()
    {
        return $this->chordOrScale;
    }

    /**
     * @param string $key
     */
    public function setChordOrScale($chordOrScale)
    {
        $this->chordOrScale = $chordOrScale;
    }

    /**
     * @return text
     */
    public function getDifficultyRange()
    {
        return $this->difficultyRange;
    }

    /**
     * @param string $difficultyRange
     */
    public function setDifficultyRange($difficultyRange)
    {
        $this->difficultyRange = $difficultyRange;
    }

    /**
     * @return int
     */
    public function getEpisodeNumber()
    {
        return $this->episodeNumber;
    }

    /**
     * @param int $episodeNumber
     */
    public function setEpisodeNumber($episodeNumber)
    {
        $this->episodeNumber = $episodeNumber;
    }

    /**
     * @return text
     */
    public function getExerciseBookPages()
    {
        return $this->exerciseBookPages;
    }

    /**
     * @param string $exerciseBookPages
     */
    public function setExerciseBookPages($exerciseBookPages)
    {
        $this->exerciseBookPages = $exerciseBookPages;
    }

    /**
     * @return int
     */
    public function getFastBpm()
    {
        return $this->fastBpm;
    }

    /**
     * @param int $fastBpm
     */
    public function setFastBpm($fastBpm)
    {
        $this->fastBpm = $fastBpm;
    }

    /**
     * @return bool
     */
    public function isSongIncluded()
    {
        return $this->includesSong;
    }

    /**
     * @param bool $includesSong
     */
    public function setIncludesSong($includesSong)
    {
        $this->includesSong = $includesSong;
    }

    /**
     * @return text
     */
    public function getInstructors()
    {
        return $this->instructors;
    }

    /**
     * @param string $instructors
     */
    public function setInstructors($instructors)
    {
        $this->instructors = $instructors;
    }

    /**
     * @param  \DateTime $liveEventStartTime
     */
    public function setLiveEventStartTime($liveEventStartTime)
    {
        $this->liveEventStartTime = $liveEventStartTime;
    }

    /**
     * @return string
     */
    public function getLiveEventStartTime()
    {
        return $this->liveEventStartTime;
    }

    /**
     * @param  \DateTime $liveEventEndTime
     */
    public function setLiveEventEndTime($liveEventEndTime)
    {
        $this->liveEventEndTime = $liveEventEndTime;
    }

    /**
     * @return \DateTime
     */
    public function getLiveEventEndTime()
    {
        return $this->liveEventEndTime;
    }

    /**
     * @param  \DateTime $liveEventStartTime
     */
    public function setLiveEventYoutubeId($liveEventYoutubeId)
    {
        $this->liveEventYoutubeId = $liveEventYoutubeId;
    }

    /**
     * @return string
     */
    public function getLiveEventYoutubeId()
    {
        return $this->liveEventYoutubeId;
    }

    /**
     * @param  string $liveStreamFeedType
     */
    public function setLiveStreamFeedType($liveStreamFeedType)
    {
        $this->liveStreamFeedType = $liveStreamFeedType;
    }

    /**
     * @return string
     */
    public function getLiveStreamFeedType()
    {
        return $this->liveStreamFeedType;
    }

    /**
     * @param  string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  \DateTime $released
     */
    public function setReleased($released)
    {
        $this->released = $released;
    }

    /**
     * @return \DateTime
     */
    public function getReleased()
    {
        return $this->released;
    }

    /**
     * @param  string $liveStreamFeedType
     */
    public function setSlowBpm($slowBpm)
    {
        $this->slowBpm = $slowBpm;
    }

    /**
     * @return string
     */
    public function getSlowBpm()
    {
        return $this->slowBpm;
    }

    /**
     * @param  string $totalXp
     */
    public function setTotalXp($totalXp)
    {
        $this->totalXp = $totalXp;
    }

    /**
     * @return string
     */
    public function getTotalXp()
    {
        return $this->totalXp;
    }

    /**
     * @param  string $transcriberName
     */
    public function setTranscriberName($transcriberName)
    {
        $this->transcriberName = $transcriberName;
    }

    /**
     * @return string
     */
    public function getTranscriberName()
    {
        return $this->transcriberName;
    }

    /**
     * @return int
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * @param int $week
     */
    public function setWeek($week)
    {
        $this->week = $week;
    }

    /**
     * @return text
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * @param string $key
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;
    }

    /**
     * @return string
     */
    public function getSoundsliceSlug()
    {
        return $this->soundsliceSlug;
    }

    /**
     * @param string $soundsliceSlug
     */
    public function setSoundsliceSlug($soundsliceSlug)
    {
        $this->soundsliceSlug = $soundsliceSlug;
    }

    /**
     * @return int
     */
    public function getStaffPickRating()
    {
        return $this->staffPickRating;
    }

    /**
     * @param $staffPickRating
     */
    public function setStaffPickRating($staffPickRating)
    {
        $this->staffPickRating = $staffPickRating;
    }

    /**
     * @return integer
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * @param $studentId
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;
    }

    /**
     * @return string
     */
    public function getVimeoVideoId()
    {
        return $this->vimeoVideoId;
    }

    /**
     * @param $vimeoVideoId
     */
    public function setVimeoVideoId($vimeoVideoId)
    {
        $this->vimeoVideoId = $vimeoVideoId;
    }

    /**
     * @return string
     */
    public function getYoutubeVideoId()
    {
        return $this->youtubeVideoId;
    }

    /**
     * @param $youtubeVideoId
     */
    public function setYoutubeVideoId($youtubeVideoId)
    {
        $this->youtubeVideoId = $youtubeVideoId;
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
     * @return Content|null
     */
    public function getExercise()
    {
        return $this->exercise;
    }

    /**
     * @return Content|null
     */
    public function getInstructor()
    {
        return $this->instructor;
    }

    /**
     * @return Content|null
     */
    public function getVimeoVideo()
    {
        return $this->vimeoVideo;
    }

    /**
     * @return Content|null
     */
    public function getData()
    {
        return $this->data;
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
     * @param ContentInstructor $instructor
     * @return $this
     */
    public function addInstructor(ContentInstructor $instructor)
    {
        $this->instructor[] = $instructor->getInstructor();

        return $this;
    }

    /**
     * @param ContentTopic $contentTopic
     * @return $this
     */
    public function addTopic(ContentTopic $contentTopic)
    {
        $this->topic[] = $contentTopic;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @return ArrayCollection
     */
    public function setTopic($topic)
    {
        $this->topic[] = $topic;
    }
}