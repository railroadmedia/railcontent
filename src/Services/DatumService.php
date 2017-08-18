<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\DatumRepository;

class DatumService
{
    private $datumRepository;

    public function __construct (DatumRepository $datumRepository)
    {
        $this->datumRepository = $datumRepository;
    }

    /**
     * Create a new field, link the category with the new created field and return the category with the linked field
     * @param integer $categoryId
     * @param string $key
     * @param string $value
     * @param string $subjectType
     * @return array
     */
    public function createSubjectDatum($subjectId, $dataId = null, $key, $value, $subjectType)
    {
        $dataId = $this->datumRepository->updateOrCreateDatum($dataId, $key, $value);

        $this->datumRepository->linkSubjectDatum($dataId, $subjectId, $subjectType);

        return $this->datumRepository->getSubjectDatum($dataId, $subjectId, $subjectType);
    }

    /**
     * Update a category field and return the category with the field
     * @param $categoryId
     * @param $key
     * @param $value
     * @return int
     */
    public function updateSubjectDatum($subjectId, $dataId, $key, $value, $subjectType)
    {
        $this->datumRepository->updateOrCreateDatum($dataId, $key ,$value);

        return  $this->datumRepository->getSubjectDatum($dataId, $subjectId, $subjectType);
    }

    /**
     * Call the repository method to unlink the category's datum
     * @param integer $dataId
     * @param integer $subjectId
     * @return bool
     */
    public function deleteSubjectDatum($dataId, $subjectId, $subjectType)
    {
        return $this->datumRepository->unlinkSubjectDatum($dataId, $subjectId, $subjectType);
    }

    /**
     * Return the subject with the linked data
     * @param integer $dataId
     * @param integer $subjectId
     * @param string $subjectType
     * @return array
     */
    public function getSubjectDatum($dataId, $subjectId, $subjectType)
    {
        return $this->datumRepository->getSubjectDatum($dataId, $subjectId, $subjectType);
    }

    /**
     * Unlink all the datum with specified type associated with the subject id
     * @param $subjectId
     * @param $subjectType
     */
    public function unlinkSubjectDatum($subjectId, $subjectType)
    {
        return $this->datumRepository->unlinkAllSubjectDatum($subjectId, $subjectType);
    }
}