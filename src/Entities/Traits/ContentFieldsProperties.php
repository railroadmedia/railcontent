<?php

namespace Railroad\Railcontent\Entities\Traits;

trait ContentFieldsProperties
{
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

}