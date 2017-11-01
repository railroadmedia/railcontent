<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentFieldRepository;

class ContentFieldService
{
    /**
     * @var ContentFieldRepository
     */
    private $fieldRepository;

    /**
     * FieldService constructor.
     *
     * @param ContentFieldRepository $fieldRepository
     */
    public function __construct(ContentFieldRepository $fieldRepository)
    {
        $this->fieldRepository = $fieldRepository;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->fieldRepository->getById($id);
    }

    /**
     * Create a new field and return it.
     *
     * @param integer $contentId
     * @param string $key
     * @param string $value
     * @param string $position
     * @param string $type
     * @return array
     */
    public function create($contentId, $key, $value, $position, $type)
    {
        $id = $this->fieldRepository->create(
            [
                'content_id' => $contentId,
                'key' => $key,
                'value' => $value,
                'position' => $position,
                'type' => $type,
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
        $this->fieldRepository->update($id, $data);

        return $this->get($id);
    }

    /**
     * Call the repository method to unlink the content's field
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->fieldRepository->delete($id);
    }

}