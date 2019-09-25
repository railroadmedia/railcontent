<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;


class ContentPlaylistRepository extends RepositoryBase
{
    use ByContentIdTrait;

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->connection()->table('railcontent_content_playlist');
    }

    /**
     * @param integer $contentId
     * @return array
     */
    public function getByContentId($contentId)
    {
        if (empty($contentId)) {
            return [];
        }
        
        return $this->query()
            ->select(['id','content_id','playlist as value','position', DB::raw("'playlist' as 'key'"), DB::raw("'string' as 'type'")])
            ->where('content_id', $contentId)
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        if (empty($contentIds)) {
            return [];
        }
        
        return $this->query()
            ->select(['id','content_id','playlist as value','position', DB::raw("'playlist' as 'key'"), DB::raw("'string' as 'type'")])
            ->whereIn('content_id', array_unique($contentIds))
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();
    }

    public function getByContentIdsQuery(array $contentIds)
    {
        return $this->query()
            ->select(
                [
                    'content_id',
                    'playlist as value',
                    'position',
                    DB::raw("'playlist' as 'key'"),
                    DB::raw("'string' as 'type'"),
                ]
            )
            ->whereIn('content_id', $contentIds);
    }
}