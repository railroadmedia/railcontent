<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Services\ConfigService;

class ContentTagRepository extends RepositoryBase
{

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->connection()
            ->table(ConfigService::$tableContentTag);
    }

    /**
     * @return array
     */
    public function columns()
    {
        return [
            'id',
            'content_id',
            'tag as value',
            'position',
            DB::raw("'tag' as 'key'"),
            DB::raw("'string' as 'type'"),
        ];
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
            ->select($this->columns())
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

        return $this->getByContentIdsQuery($contentIds)
            ->get()
            ->toArray();
    }

    /**
     * @param array $contentIds
     * @return Builder
     */
    public function getByContentIdsQuery(array $contentIds)
    {
        return $this->query()
            ->select($this->columns())
            ->whereIn('content_id', $contentIds)
            ->orderBy('position', 'asc');
    }

    /**
     * @param int $id
     * @return array|Model|Builder|mixed|object|null
     */
    public function getById($id)
    {
        return $this->query()
            ->select($this->columns())
            ->where(['id' => $id])
            ->first();
    }
}