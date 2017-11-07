<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Events\ContentUpdated;
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
     * @param array $data
     * @return array
     */
    public function update($id, array $data)
    {
        //check if datum exist in the database
        $datum = $this->get($id);

        if (is_null($datum)) {
            return $datum;
        }

        //don't update the datum if the request not contain any value
        if(count($data) == 0) {
            return $datum;
        }

        //save a content version before datum update
        // todo: this should be after the datum is saved, or renamed to 'ContentUpdating' if its being triggered before the actual update
        event(new ContentUpdated($datum['content_id']));

        $this->datumRepository->update($id, $data);

        return $this->get($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        //check if datum exist in the database
        $datum = $this->get($id);

        if (is_null($datum)) {
           return $datum;
        }

        //save a content version before datum deletion
        // todo: this should be after the datum is deleted and renamed to DatumDeleted
        event(new ContentUpdated($datum['content_id']));

        return $this->datumRepository->delete($id);
    }
}