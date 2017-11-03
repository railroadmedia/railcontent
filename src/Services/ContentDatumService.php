<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentDatumRepository;

class ContentDatumService
{
    /**
     * @var ContentDatumRepository
     */
    private $datumRepository;

    /**
     * DatumService constructor.
     *
     * @param ContentDatumRepository $datumRepository
     */
    public function __construct(ContentDatumRepository $datumRepository)
    {
        $this->datumRepository = $datumRepository;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->datumRepository->getById($id);
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->datumRepository->getByContentIds($contentIds);
    }

    /**
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @param integer $position
     * @return array
     */
    public function create($contentId, $key, $value, $position)
    {
        $id = $this->datumRepository->create(
            [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => $position
            ]
        );

        return $this->get($id);
    }

    /**
     * @param integer $id
     * @param $contentId
     * @param $key
     * @param $value
     * @param $position
     * @return array
     */
    public function update($id, $contentId, $key, $value, $position)
    {
        $this->datumRepository->update(
            $id,
            [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => $position
            ]
        );

        return $this->get($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->datumRepository->delete($id);
    }
}