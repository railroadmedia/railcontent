<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Repositories\ContentLikeRepository;

class ContentLikeService
{
    /**
     * @var ContentLikeRepository
     */
    private $contentLikeRepository;

    /**
     * ContentLikeService constructor.
     *
     * @param ContentLikeRepository $contentLikeRepository
     */
    public function __construct(ContentLikeRepository $contentLikeRepository)
    {
        $this->contentLikeRepository = $contentLikeRepository;
    }

    /**
     * @return Builder
     */
    public function builder()
    {
        return $this->contentLikeRepository->query();
    }

    /**
     * @param Builder $query
     * @return \Illuminate\Support\Collection
     */
    public function index($query)
    {
        return Decorator::decorate($query->get(), 'content_likes');
    }

    /**
     * @param Builder $query
     * @return int
     */
    public function count($query)
    {
        return $query->count();
    }

    /**
     * Returns array with content ids as the key and like count as the value.
     * [46236 => 5]
     *
     * @param $contentIds
     * @return array
     */
    public function countForContentIds($contentIds)
    {
        $results =
            $this->contentLikeRepository->query()
                ->selectRaw(
                    $this->contentLikeRepository->connection()
                        ->raw('content_id, COUNT(*) as count')
                )
                ->whereIn('content_id', $contentIds)
                ->groupBy('content_id')
                ->get()
                ->toArray();

        $parsedResults = [];

        foreach ($results as $result) {
            $parsedResults[$result['content_id']] = $result['count'];
        }

        return $parsedResults;
    }

    /**
     * @param $contentId
     * @param $userId
     * @return array
     */
    public function like($contentId, $userId)
    {
        $stored =
            $this->contentLikeRepository->query()
                ->updateOrInsert(
                    [
                        'content_id' => $contentId,
                        'user_id' => $userId,
                    ],
                    [
                        'created_on' => Carbon::now()
                            ->toDateTimeString(),
                    ]
                );

        return $this->contentLikeRepository->query()
            ->where(
                [
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ]
            )
            ->first();
    }

    /**
     * @param $contentId
     * @param $userId
     * @return int
     */
    public function unlike($contentId, $userId)
    {
        return $this->contentLikeRepository->query()
            ->where(
                [
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ]
            )
            ->delete();
    }
}