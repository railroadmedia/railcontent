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
        return $this->datumRepository->get($id);
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
     * Create a new datum, link the content with the new created datum.
     *
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @param integer $position
     * @return array
     */
    public function create($contentId, $key, $value, $position)
    {
        $id = $this->datumRepository->create($contentId, $key, $value, $position);

        return $this->get($id);
    }

    /**
     * Update the datum and return the new datum.
     *
     * @param integer $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data)
    {
        $this->datumRepository->update($id, $data);

        return $this->get($id);
    }

    /**
     * Call the repository method to unlink the content's datum
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->datumRepository->delete($id);
    }
}