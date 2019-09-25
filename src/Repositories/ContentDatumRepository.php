<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
use Railroad\Railcontent\Services\ConfigService;

class ContentDatumRepository extends RepositoryBase
{
    use ByContentIdTrait;

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->connection()->table(ConfigService::$tableContentData);
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
            ->whereIn('content_id', array_unique($contentIds))
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();
    }

    /**
     * @param array $keys
     * @param array $contentIds
     * @return array
     */
    public function getByKeysAndContentIds(array $keys, array $contentIds)
    {
        if (empty($contentIds)||(empty($keys))) {
            return [];
        }

        return $this->query()
            ->whereIn('content_id', array_unique($contentIds))
            ->whereIn('key', $keys)
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();
    }

    /**
     * @param array $keys
     * @param $contentId
     * @return array
     */
    public function getByKeysAndContentId(array $keys, $contentId)
    {
        if (empty($contentId)||(empty($keys))) {
            return [];
        }

        return $this->query()
            ->where('content_id', $contentId)
            ->whereIn('key', $keys)
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();
    }

    /**
     * @param array $keys
     * @param array $contentIds
     * @return array
     */
    public function getByKeysAndContentIdsQuery(array $keys, array $contentIds)
    {
        if (empty($contentIds)||(empty($keys))) {
            return [];
        }

        return $this->query()
            ->select(
                [
                    'content_id',
                    'value',
                    'key',
                    'position',
                    DB::raw("'string' as 'type'"),
                ]
            )
            ->whereIn('content_id', $contentIds)
            ->whereIn('key', $keys);
    }
}