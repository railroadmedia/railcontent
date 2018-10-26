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

    /**
     * @param null $dataId
     * @param $data
     * @return bool|int
     */
    public function createOrUpdateAndReposition($dataId = null, $data)
    {
        $existingData = $this->query()->read($dataId);
        $contentId = $existingData['content_id'] ?? $data['content_id'];
        $key = $existingData['key'] ?? $data['key'];

        $dataCount = $this->query()
            ->where(
                [
                    'content_id' => $contentId,
                    'key' => $key
                ]
            )
            ->count();

        $data['position'] = $this->recalculatePosition(
            $data['position'] ?? $existingData['position'],
            $dataCount,
            $existingData
        );

        if (!($existingData)) {
            $this->incrementOtherEntitiesPosition(
                null,
                $contentId,
                $key,
                $data['position'],
                null
            );

            return $this->query()->create($data);

        } elseif ($data['position'] > $existingData['position']) {
            $updated = $this->query()
                ->where('id', $dataId)
                ->update($data);

            $this->decrementOtherEntitiesPosition(
                $dataId,
                $contentId,
                $key,
                $existingData['position'],
                $data['position']
            );
            return $updated;

        } elseif ($data['position'] < $existingData['position']) {
            $updated = $this->query()
                ->where('id', $dataId)
                ->update($data);

            $this->incrementOtherEntitiesPosition(
                $dataId,
                $contentId,
                $key,
                $data['position'],
                $existingData['position']
            );

            return $updated;

        } else {
            $this->query()->update($dataId, $data);
            return $this->read($dataId);
        }
    }

    private function recalculatePosition($position, $dataCount, $existingData)
    {
        if ($position === null || $position > $dataCount) {
            if (empty($existingData)) {
                $position = $dataCount + 1;
            } else {
                $position = $dataCount;
            }
        }

        if ($position < 1) {
            $position = 1;
        }

        return $position;
    }

    private function incrementOtherEntitiesPosition(
        $excludedEntityId = null,
        $contentId,
        $key,
        $startPosition,
        $endPosition = null
    ) {
        $query = $this->query()
            ->where('content_id', $contentId)
            ->where('key', $key)
            ->where('position', '>=', $startPosition);

        if ($excludedEntityId) {
            $query->where('id', '!=', $excludedEntityId);
        }

        if ($endPosition) {
            $query->where('position', '<', $endPosition);
        }

        return $query->increment('position') > 0;
    }

    private function decrementOtherEntitiesPosition(
        $excludedEntityId,
        $contentId,
        $key,
        $startPosition,
        $endPosition
    ) {
        return $this->query()
                ->where('content_id', $contentId)
                ->where('key', $key)
                ->where('id', '!=', $excludedEntityId)
                ->where('position', '>', $startPosition)
                ->where('position', '<=', $endPosition)
                ->decrement('position') > 0;
    }

    /**
     * @param $entity
     * @param string $positionColumnPrefix
     * @return bool
     */
    public function deleteAndReposition($entity, $positionColumnPrefix = '')
    {
        $existingLink = $this->query()
            ->where($entity)
            ->first();

        if (empty($existingLink)) {
            return true;
        }

        $query = $this->query();
        if(array_key_exists('content_id', $existingLink)){
            $query->where(
                [
                    'content_id' => $existingLink['content_id'],
                    'key' => $existingLink['key'],
                ]
            );
        }

        if(array_key_exists('parent_id', $existingLink)){
            $query->where('parent_id', $existingLink['parent_id']);
        }

        $query->where(
            $positionColumnPrefix . 'position',
            '>',
            $existingLink[$positionColumnPrefix . "position"]
        )
            ->decrement($positionColumnPrefix . 'position');

        $deleted = $this->query()->destroy($existingLink['id']);

        return $deleted > 0;
    }
}