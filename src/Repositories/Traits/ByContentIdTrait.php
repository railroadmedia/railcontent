<?php

namespace Railroad\Railcontent\Repositories\Traits;

trait ByContentIdTrait
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
     * Unlink all datum for a content id.
     *
     * @param $contentId
     * @return int
     */
    public function deleteByContentId($contentId)
    {
        return $this->query()->where('content_id', $contentId)->delete() > 0;
    }
}