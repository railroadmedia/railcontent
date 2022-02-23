<?php

namespace Railroad\Railcontent\Entities\Traits;

use DateTime;
use Doctrine\Search\Mapping\Annotations as MAP;

trait ContentFieldsProperties
{
    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $difficulty;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
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
    protected $title;

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
     * @ORM\Column(type="string", nullable=true)
     * @var string
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
     * @ORM\Column(type="string", nullable=true)
     * @var string
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
     * @var DateTime
     */
    protected $liveEventStartTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTime
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
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $highSoundsliceSlug;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $lowSoundsliceSlug;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var integer
     */
    protected $highVideo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var integer
     */
    protected $lowVideo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var integer
     */
    protected $originalVideo;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $pdf;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $pdfInG;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $sbtBpm;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var integer
     */
    protected $sbtExerciseNumber;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $songName;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $soundsliceXmlFileUrl;

    /**
     * @return string
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
     * @return string
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
     * @return int
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
     * @return string
     */
    public function getQnaVideo()
    {
        return $this->qnaVideo;
    }

    /**
     * @param $qnaVideo
     */
    public function setQnaVideo($qnaVideo)
    {
        $this->qnaVideo = $qnaVideo;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getXp()
    {
        return $this->xp;
    }

    /**
     * @param $xp
     */
    public function setXp($xp)
    {
        $this->xp = $xp;
    }

    /**
     * @return string
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * @param $album
     */
    public function setAlbum($album)
    {
        $this->album = $album;
    }

    /**
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    /**
     * @return string
     */
    public function getBpm()
    {
        return $this->bpm;
    }

    /**
     * @param $bpm
     */
    public function setBpm($bpm)
    {
        $this->bpm = $bpm;
    }

    /**
     * @return string
     */
    public function getCdTracks()
    {
        return $this->cdTracks;
    }

    /**
     * @param $cdTracks
     */
    public function setCdTracks($cdTracks)
    {
        $this->cdTracks = $cdTracks;
    }

    /**
     * @return string
     */
    public function getChordOrScale()
    {
        return $this->chordOrScale;
    }

    /**
     * @param $chordOrScale
     */
    public function setChordOrScale($chordOrScale)
    {
        $this->chordOrScale = $chordOrScale;
    }

    /**
     * @return string
     */
    public function getDifficultyRange()
    {
        return $this->difficultyRange;
    }

    /**
     * @param $difficultyRange
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
     * @param $episodeNumber
     */
    public function setEpisodeNumber($episodeNumber)
    {
        $this->episodeNumber = $episodeNumber;
    }

    /**
     * @return string
     */
    public function getExerciseBookPages()
    {
        return $this->exerciseBookPages;
    }

    /**
     * @param $exerciseBookPages
     */
    public function setExerciseBookPages($exerciseBookPages)
    {
        $this->exerciseBookPages = $exerciseBookPages;
    }

    /**
     * @return string
     */
    public function getFastBpm()
    {
        return $this->fastBpm;
    }

    /**
     * @param $fastBpm
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
     * @param $includesSong
     */
    public function setIncludesSong($includesSong)
    {
        $this->includesSong = $includesSong;
    }

    /**
     * @return string
     */
    public function getInstructors()
    {
        return $this->instructors;
    }

    /**
     * @param $instructors
     */
    public function setInstructors($instructors)
    {
        $this->instructors = $instructors;
    }

    /**
     * @param  DateTime $liveEventStartTime
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
     * @param  DateTime $liveEventEndTime
     */
    public function setLiveEventEndTime($liveEventEndTime)
    {
        $this->liveEventEndTime = $liveEventEndTime;
    }

    /**
     * @return DateTime
     */
    public function getLiveEventEndTime()
    {
        return $this->liveEventEndTime;
    }

    /**
     * @param $liveEventYoutubeId
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
     * @param $liveStreamFeedType
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
     * @param  DateTime $released
     */
    public function setReleased($released)
    {
        $this->released = $released;
    }

    /**
     * @return DateTime
     */
    public function getReleased()
    {
        return $this->released;
    }

    /**
     * @param $slowBpm
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
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * @param $avatarUrl
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
     * @return int
     */
    public function getLengthInSeconds()
    {
        return $this->lengthInSeconds;
    }

    /**
     * @param int $lengthInSeconds
     */
    public function setLengthInSeconds($lengthInSeconds)
    {
        $this->lengthInSeconds = $lengthInSeconds;
    }

    /**
     * @return string
     */
    public function getHighSoundsliceSlug()
    {
        return $this->highSoundsliceSlug;
    }

    /**
     * @param $highSoundsliceSlug
     */
    public function setHighSoundsliceSlug($highSoundsliceSlug)
    {
        $this->highSoundsliceSlug = $highSoundsliceSlug;
    }

    /**
     * @return string
     */
    public function getLowSoundsliceSlug()
    {
        return $this->lowSoundsliceSlug;
    }

    /**
     * @param $lowSoundsliceSlug
     */
    public function setLowSoundsliceSlug($lowSoundsliceSlug)
    {
        $this->lowSoundsliceSlug = $lowSoundsliceSlug;
    }

    /**
     * @return int
     */
    public function getHighVideo()
    {
        return $this->highVideo;
    }

    /**
     * @param int $lowVideo
     */
    public function setLowVideo(int $lowVideo)
    {
        $this->lowVideo = $lowVideo;
    }

    /**
     * @return int
     */
    public function getLowVideo()
    {
        return $this->lowVideo;
    }

    /**
     * @param int $highVideo
     */
    public function setHighVideo(int $highVideo)
    {
        $this->highVideo = $highVideo;
    }

    /**
     * @return int
     */
    public function getOriginalVideo()
    {
        return $this->originalVideo;
    }

    /**
     * @param int $originalVideo
     */
    public function setOriginalVideo(int $originalVideo)
    {
        $this->originalVideo = $originalVideo;
    }

    /**
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * @param $pdf
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * @return string
     */
    public function getPdfInG()
    {
        return $this->pdfInG;
    }

    /**
     * @param $pdfInG
     */
    public function setPdfInG($pdfInG)
    {
        $this->pdfInG = $pdfInG;
    }

    /**
     * @return string
     */
    public function getSbtBpm()
    {
        return $this->sbtBpm;
    }

    /**
     * @param $sbtBpm
     */
    public function setSbtBpm($sbtBpm)
    {
        $this->sbtBpm = $sbtBpm;
    }

    /**
     * @return int
     */
    public function getSbtExerciseNumber()
    {
        return $this->sbtExerciseNumber;
    }

    /**
     * @param int $sbtExerciseNumber
     */
    public function setSbtExerciseNumber(int $sbtExerciseNumber)
    {
        $this->sbtExerciseNumber = $sbtExerciseNumber;
    }

    /**
     * @return string
     */
    public function getSongName()
    {
        return $this->songName;
    }

    /**
     * @param $songName
     */
    public function setSongName($songName)
    {
        $this->songName = $songName;
    }

    /**
     * @return string
     */
    public function getSoundsliceXmlFileUrl()
    {
        return $this->soundsliceXmlFileUrl;
    }

    /**
     * @param $soundsliceXmlFileUrl
     */
    public function setSoundsliceXmlFileUrl($soundsliceXmlFileUrl)
    {
        $this->soundsliceXmlFileUrl = $soundsliceXmlFileUrl;
    }

}