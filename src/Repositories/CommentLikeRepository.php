<?php

namespace Railroad\Railcontent\Repositories;

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
        $results = $this->query()
            ->selectRaw($this->connection()->raw('comment_id, COUNT(*) as count'))
            ->whereIn('comment_id', $commentIds)
            ->groupBy('comment_id')
            ->get()
            ->toArray();

        return array_combine(array_column($results, 'comment_id'), array_column($results, 'count'));
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

        return array_combine(array_column($results, 'comment_id'), array_column($results, 'is_liked'));
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
            ->where('user_id', '!=', auth()->id())
            ->orderBy('created_on', 'desc')
            ->groupBy('user_id', 'created_on', 'comment_id')
            ->limit($amountOfUserIdsToPull);

        foreach ($commentIds as $commentIdIndex => $commentId) {
            if ($commentIdIndex > 0) {
                $query->unionAll(
                    $this->query()
                        ->select(['comment_id', 'user_id'])
                        ->where('comment_id', $commentId)
                        ->where('user_id', '!=', auth()->id())
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