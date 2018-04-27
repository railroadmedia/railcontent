<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Services\ConfigService;

class CommentLikeRepository extends RepositoryBase
{
    /**
     * @param $commentIds
     * @return array|null
     */
    public function getByCommentIds($commentIds)
    {
        return $this->query()->whereIn('comment_id', $commentIds)->getToArray();
    }

    /**
     * Returns [[id, count], ...]
     *
     * @param $commentIds
     * @return array
     */
    public function countForCommentIds($commentIds)
    {
        return $this->query()
            ->selectRaw($this->connection()->raw('comment_id, COUNT(*) as count'))
            ->whereIn('comment_id', $commentIds)
            ->groupBy('comment_id')
            ->get()
            ->toArray();
    }

    /**
     * @param $commentIds
     * @return array
     */
    public function getUserIdsForEachCommentId($commentIds, $amountOfUserIdsToPull)
    {
        return $this->query()
            ->selectRaw($this->connection()->raw(ConfigService::$tableCommentLikes . '.*'))
            ->leftJoin(
                ConfigService::$tableCommentLikes . ' as comment_likes_2',
                function (JoinClause $joinClause) {
                    return $joinClause
                        ->on(
                            ConfigService::$tableCommentLikes . '.comment_id',
                            '=',
                            'comment_likes_2.comment_id'
                        )
                        ->on(ConfigService::$tableCommentLikes . '.id', '<', 'comment_likes_2.id');
                }
            )
            ->whereIn(ConfigService::$tableCommentLikes . '.comment_id', $commentIds)
            ->groupBy(ConfigService::$tableCommentLikes . '.id')
            ->havingRaw($this->connection()->raw('COUNT(*) < 3'))
            ->orderByRaw($this->connection()->raw(ConfigService::$tableCommentLikes . '.created_on, ' . ConfigService::$tableCommentLikes . '.id, ' . ConfigService::$tableCommentLikes . '.comment_id DESC'))
            ->get()
            ->toArray();
    }

    /**
     * @param $userId
     * @param $commentId
     * @return int
     */
    public function deleteForUserComment($userId, $commentId)
    {
        return $this->query()->where(['user_id' => $userId, 'comment_id' => $commentId])
            ->delete();
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    protected function query()
    {
        return $this->connection()->table(ConfigService::$tableCommentLikes);
    }
}