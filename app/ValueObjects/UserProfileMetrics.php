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
     */
    public function __construct(int $xp, int $daysAsMember, int $commentLikes, int $minutesPracticed, int $forumPostLikes)
    {
        $this->xp = $xp;
        $this->daysAsMember = $daysAsMember;
        $this->commentLikes = $commentLikes;
        $this->minutesPracticed = $minutesPracticed;
        $this->forumPostLikes = $forumPostLikes;
    }

    public function getXp(): int
    {
        return $this->xp;
    }

    public function getDaysAsMember(): int
    {
        return $this->daysAsMember;
    }

    public function getCommentLikes(): int
    {
        return $this->commentLikes;
    }

    public function getMinutesPracticed(): int
    {
        return $this->minutesPracticed;
    }

    public function getForumPostLikes(): int
    {
        return $this->forumPostLikes;
    }
}
