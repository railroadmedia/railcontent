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
     * Create a new datum, link the content with the new created datum and
     * return the content with the linked datum
     *
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @param integer $position
     * @return array
     */
    public function createDatum($contentId, $key, $value, $position)
    {
        $dataId = $this->datumRepository->updateOrCreateDatum(null, $key, $value, $position);

        $this->contentRepository->linkDatum($contentId, $dataId);

        return $this->contentRepository->getLinkedDatum($dataId, $contentId);
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
        $this->datumRepository->updateOrCreateDatum($dataId, $key, $value, $position);

        return $this->contentRepository->getLinkedDatum($dataId, $contentId);
    }

    /**
     * Call the repository method to unlink the content's datum
     *
     * @param integer $dataId
     * @param integer $contentId
     * @return bool
     */
    public function deleteDatum($dataId, $contentId)
    {
        return $this->contentRepository->unlinkDatum($contentId, $dataId);
    }

    /**
     * Return the content with the linked data
     *
     * @param integer $dataId
     * @param integer $contentId
     * @return array
     */
    public function getDatum($dataId, $contentId)
    {
        return $this->contentRepository->getLinkedDatum($dataId, $contentId);
    }
}