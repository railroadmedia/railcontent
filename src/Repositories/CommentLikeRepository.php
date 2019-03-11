<?php

namespace Railroad\Railcontent\Repositories;

use Doctrine\ORM\EntityRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Resora\Queries\CachedQuery;

class CommentLikeRepository extends EntityRepository
{
    /**
     * Returns [[id, count], ...]
     *
     * @param $commentIds
     * @return array
     */
    public function isLikedByUserId($commentAndReplyIds, $userId)
    {
        $results = $this->query()
            ->selectRaw($this->connection()->raw('comment_id, COUNT(*) > 0 as is_liked'))
            ->whereIn('comment_id', $commentAndReplyIds)
            ->where('user_id', $userId)
            ->groupBy('comment_id')
            ->get()
            ->toArray();

        return array_combine(array_column($results, 'comment_id'), array_column($results, 'is_liked'));
    }
}