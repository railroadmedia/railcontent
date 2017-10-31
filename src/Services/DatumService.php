<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\DatumRepository;

class DatumService
{
    /**
     * @var DatumRepository
     */
    private $datumRepository;

    /**
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * DatumService constructor.
     *
     * @param DatumRepository $datumRepository
     * @param ContentRepository $contentRepository
     */
    public function __construct(DatumRepository $datumRepository, ContentRepository $contentRepository)
    {
        $this->datumRepository = $datumRepository;
        $this->contentRepository = $contentRepository;
    }

    /**
     * Create a new datum, link the content with the new created datum.
     *
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @param integer $position
     * @return int
     */
    public function createDatum($contentId, $key, $value, $position)
    {
        $dataId = $this->datumRepository->createDatum($key, $value, $position);

        return $this->datumRepository->linkContentToDatum($contentId, $dataId);
    }

    /**
     * Update a content datum and return the content with the datum
     *
     * @param integer $contentId
     * @param int $dataId
     * @param string $key
     * @param string $value
     * @param int $position
     * @return int
     */
    public function updateDatum($contentId, $dataId, $key, $value, $position)
    {
        return $this->datumRepository->updateOrCreateDatum($dataId, $key, $value, $position);
    }

    /**
     * Call the repository method to unlink the content's datum
     *
     * @param $id
     * @return bool
     */
    public function deleteDatum($id)
    {
        return $this->datumRepository->deleteDatum($id);
    }
}