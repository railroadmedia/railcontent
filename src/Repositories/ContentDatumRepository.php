<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

class ContentDatumRepository extends RepositoryBase
{
    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->query()->where(['id' => $id])->first();
    }

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
     * Returns new record id.
     *
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @param integer $position
     * @return int
     */
    public function create($contentId, $key, $value, $position)
    {
        $existing = $this->query()->where(
            [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => $position
            ]
        )
            ->first();

        if (empty($existing)) {
            return $this->query()->insertGetId(
                [
                    'content_id' => $contentId,
                    'key' => $key,
                    'value' => $value,
                    'position' => $position
                ]
            );
        }

        return $existing['id'];
    }

    /**
     * @param integer $id
     * @param array $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $existing = $this->query()->where(['id' => $id])->first();

        if (!empty($existing)) {
            $this->query()->where(['id' => $id])->update($data);
        }

        return $id;
    }

    /**
     * Delete a record from railcontent_data table
     *
     * @param integer $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->query()->where(['id' => $id])->delete() > 0;
    }

    /**
     * Unlink all datum for a content id.
     *
     * @param $contentId
     * @return int
     */
    public function deleteContentData($contentId)
    {
        return $this->query()->where('content_id', $contentId)->delete() > 0;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->connection()->table(ConfigService::$tableContentData);
    }
}