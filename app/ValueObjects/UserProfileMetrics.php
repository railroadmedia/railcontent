<?php

namespace App\ValueObjects;

class UserProfileMetrics
{
    /**
     * @var integer
     */
    protected $xp = 0;

    /**
     * @var integer
     */
    protected $daysAsMember = 0;

    /**
     * @var integer
     */
    protected $commentLikes = 0;

    /**
     * @var integer
     */
    protected $minutesPracticed = 0;

    /**
     * @var int
     */
    private $forumPostLikes = 0;

    /**
     * UserProfileMetrics constructor.
     *
     * @param  integer  $xp
     * @param  integer  $daysAsMember
     * @param  integer  $commentLikes
     * @param  integer  $minutesPracticed
     * @param  integer  $forumPostLikes
     */
    public function __construct(int $xp, int $daysAsMember, int $commentLikes, int $minutesPracticed, int $forumPostLikes)
    {
        $this->xp = $xp;
        $this->daysAsMember = $daysAsMember;
        $this->commentLikes = $commentLikes;
        $this->minutesPracticed = $minutesPracticed;
        $this->forumPostLikes = $forumPostLikes;
    }

    /**
     * @return int
     */
    public function getXp(): int
    {
        return $this->xp;
    }

    /**
     * @return int
     */
    public function getDaysAsMember(): int
    {
        return $this->daysAsMember;
    }

    /**
     * @return int
     */
    public function getCommentLikes(): int
    {
        return $this->commentLikes;
    }

    /**
     * @return int
     */
    public function getMinutesPracticed(): int
    {
        return $this->minutesPracticed;
    }

    /**
     * @return int
     */
    public function getForumPostLikes(): int
    {
        return $this->forumPostLikes;
    }
}
