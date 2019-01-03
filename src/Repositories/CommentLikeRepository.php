<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Services\ConfigService;
use Railroad\Resora\Queries\CachedQuery;

class CommentLikeRepository extends \Railroad\Resora\Repositories\RepositoryBase
{
    /**
     * @return CachedQuery|$this
     */
    protected function newQuery()
    {
        return (new CachedQuery($this->connection()))->from(ConfigService::$tableCommentLikes);
    }

    /**
     * Returns [[id, count], ...]
     *
     * @param $commentIds
     * @return array
     */
    public function countForCommentIds($commentIds)
    {
        $results = $this->query()
            ->selectRaw($this->connection()->raw('comment_id, COUNT(*) as count'))
            ->whereIn('comment_id', $commentIds)
            ->groupBy('comment_id')
            ->get()
            ->toArray();

        $parsedResults = [];

        foreach ($results as $result) {
            $parsedResults[$result['comment_id']] = $result['count'];
        }

        return $parsedResults;
    }

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

        $parsedResults = [];

        foreach ($results as $result) {
            $parsedResults[$result['comment_id']] = $result['is_liked'];
        }

        return $parsedResults;
    }

    /**
     * @param $commentIds
     * @return array
     */
    public function getUserIdsForEachCommentId($commentIds, $amountOfUserIdsToPull)
    {
        $commentIds = array_unique(array_values($commentIds));

        $query = $this->query()->select(['comment_id', 'user_id'])
            ->where('comment_id', $commentIds[0])
            ->orderBy('created_on', 'desc')
            ->groupBy('user_id', 'created_on', 'comment_id')
            ->limit($amountOfUserIdsToPull);

        foreach ($commentIds as $commentIdIndex => $commentId) {
            if ($commentIdIndex > 0) {
                $query->unionAll(
                    $this->newQuery()
                        ->select(['comment_id', 'user_id'])
                        ->where('comment_id', $commentId)
                        ->orderBy('created_on', 'desc')
                        ->groupBy('user_id', 'created_on', 'comment_id')
                        ->limit($amountOfUserIdsToPull)
                );
            }
        }

        $results = $query->get();
        $commentUserIds = [];

        foreach ($commentIds as $commentIdIndex => $commentId) {
            foreach ($results as $result) {
                if ($result['comment_id'] == $commentId) {
                    $commentUserIds[$commentId][] = $result['user_id'];
                }
            }
        }

        return $commentUserIds;
    }
}