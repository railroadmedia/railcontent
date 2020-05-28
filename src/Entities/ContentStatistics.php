<?php

namespace Railroad\Railcontent\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Railroad\Railcontent\Repositories\ContentStatisticsRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(
 *     name="railcontent_content_statistics",
 *     indexes={
 *         @ORM\Index(name="railcontent_content_statistics_content_id_index", columns={"content_id"}),
 *         @ORM\Index(name="railcontent_content_statistics_content_type_index", columns={"content_type"}),
 *         @ORM\Index(name="railcontent_content_statistics_content_published_on_index", columns={"content_published_on"}),
 *         @ORM\Index(name="railcontent_content_statistics_completes_index", columns={"completes"}),
 *         @ORM\Index(name="railcontent_content_statistics_starts_index", columns={"starts"}),
 *         @ORM\Index(name="railcontent_content_statistics_comments_index", columns={"comments"}),
 *         @ORM\Index(name="railcontent_content_statistics_likes_index", columns={"likes"}),
 *         @ORM\Index(name="railcontent_content_statistics_added_to_list_index", columns={"added_to_list"}),
 *         @ORM\Index(name="railcontent_content_statistics_start_interval_index", columns={"start_interval"}),
 *         @ORM\Index(name="railcontent_content_statistics_end_interval_index", columns={"end_interval"}),
 *         @ORM\Index(name="railcontent_content_statistics_week_of_year_index", columns={"week_of_year"}),
 *         @ORM\Index(name="railcontent_content_statistics_created_on_index", columns={"created_on"}),
 *         @ORM\Index(name="railcontent_content_statistics_stats_epoch_index", columns={"stats_epoch"})
 *     }
 * )
 *
 */
class ContentStatistics
{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Railroad\Railcontent\Entities\Content")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     *
     */
    private $content;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $contentType;

    /**
     * @ORM\Column(type="datetime", name="content_published_on", nullable=true)
     * @var DateTime
     */
    protected $contentPublishedOn;

    /**
     * @ORM\Column(type="integer")
     */
    protected $completes;

    /**
     * @ORM\Column(type="integer")
     */
    protected $starts;

    /**
     * @ORM\Column(type="integer")
     */
    protected $comments;

    /**
     * @ORM\Column(type="integer")
     */
    protected $likes;

    /**
     * @ORM\Column(type="integer")
     */
    protected $addedToList;

    /**
     * @ORM\Column(type="datetime", name="start_interval")
     * @var DateTime
     */
    protected $startInterval;

    /**
     * @ORM\Column(type="datetime", name="end_interval")
     * @var DateTime
     */
    protected $endInterval;

    /**
     * @ORM\Column(type="integer")
     */
    protected $weekOfYear;

    /**
     * @ORM\Column(type="integer")
     */
    protected $statsEpoch;

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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param Content $content
     */
    public function setContent(Content $content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param mixed $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * @return DateTime
     */
    public function getContentPublishedOn()
    {
        return $this->contentPublishedOn;
    }

    /**
     * @param $contentPublishedOn
     */
    public function setContentPublishedOn($contentPublishedOn)
    {
        $this->contentPublishedOn = $contentPublishedOn;
    }

    /**
     * @return mixed
     */
    public function getCompletes()
    {
        return $this->completes;
    }

    /**
     * @param $completes
     */
    public function setCompletes($completes)
    {
        $this->completes = $completes;
    }

    /**
     * @return mixed
     */
    public function getStarts()
    {
        return $this->starts;
    }

    /**
     * @param $starts
     */
    public function setStarts($starts)
    {
        $this->starts = $starts;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

    /**
     * @return mixed
     */
    public function getAddedToList()
    {
        return $this->addedToList;
    }

    /**
     * @param $addedToList
     */
    public function setAddedToList($addedToList)
    {
        $this->addedToList = $addedToList;
    }

    /**
     * @return DateTime
     */
    public function getStartInterval()
    {
        return $this->startInterval;
    }

    /**
     * @param $startInterval
     */
    public function setStartInterval($startInterval)
    {
        $this->startInterval = $startInterval;
    }

    /**
     * @return DateTime
     */
    public function getEndInterval()
    {
        return $this->endInterval;
    }

    /**
     * @param $endInterval
     */
    public function setEndInterval($endInterval)
    {
        $this->endInterval = $endInterval;
    }

    /**
     * @return mixed
     */
    public function getWeekOfYear()
    {
        return $this->weekOfYear;
    }

    /**
     * @param $weekOfYear
     */
    public function setWeekOfYear($weekOfYear)
    {
        $this->weekOfYear = $weekOfYear;
    }

    /**
     * @return mixed
     */
    public function getStatsEpoch()
    {
        return $this->statsEpoch;
    }

    /**
     * @param $statsEpoch
     */
    public function setStatsEpoch($statsEpoch)
    {
        $this->statsEpoch = $statsEpoch;
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