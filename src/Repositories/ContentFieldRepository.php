<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

class ContentFieldRepository extends RepositoryBase
{
    /**
     * @param integer $contentId
     * @return array
     */
    public function getByContentId($contentId)
    {
        return $this->query()->where('content_id', $contentId)->get()->toArray();
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->query()->whereIn('content_id', $contentIds)->get()->toArray();
    }

    /**
     * @param $contentId
     * @return int
     */
    public function deleteContentFields($contentId)
    {
        return $this->query()->where('content_id', $contentId)->delete() > 0;
    }

    /**
     * @return Builder
     */
    protected function query()
    {
        return $this->connection()->table(ConfigService::$tableContentFields);
    }
}