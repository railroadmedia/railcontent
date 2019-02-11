<?php

namespace Railroad\Railcontent\Repositories\Traits;

use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentField;

trait ByContentIdTrait
{
    /**
     * @param integer $contentId
     * @return array
     */
    public function getByContentId($contentId)
    {
        return $this->query()
            ->where('content_id', $contentId)
            ->get()
            ->toArray();
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->query()
            ->whereIn('content_id', $contentIds)
            ->get()
            ->toArray();
    }

    /**
     * Unlink all datum for a content id.
     *
     * @param $contentId
     * @return int
     */
    public function deleteByContentId($contentId)
    {
        return $this->query()
                ->where('content_id', $contentId)
                ->delete() > 0;
    }

    /**
     * @param null $dataId
     * @param $data
     * @return bool|int
     */
    public function createOrUpdateAndReposition($dataId = null, $data)
    {
        $existingData =
            $this->query()
                ->read($dataId);
        $contentId = $existingData['content_id'] ?? $data['content_id'];
        $key = $existingData['key'] ?? $data['key'];

        $dataCount =
            $this->query()
                ->where(
                    [
                        'content_id' => $contentId,
                        'key' => $key,
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

            return $this->query()
                ->create($data);

        } elseif ($data['position'] > $existingData['position']) {
            dd('update');
            $updated =
                $this->query()
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
            dd('mai mic');
            $updated =
                $this->query()
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
            $this->query()
                ->update($dataId, $data);
            return $this->read($dataId);
        }
    }

    public function recalculatePosition($position, $dataCount, $existingData)
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
        $q =
            $this->createQueryBuilder('c')
                ->where('c.content = :id')
                ->andWhere('c.key = :key')
                ->andWhere('c.position >= :position')
                ->setParameters(
                    [
                        'id' => $contentId,
                        'key' => $key,
                        'position' => $startPosition,
                    ]
                );

        if ($excludedEntityId) {
            $q->andWhere('c.id != :excludedId')
                ->setParameter('excludedId', $excludedEntityId);
        }
        if ($endPosition) {
            $q->andWhere('c.position < :endPosition')
                ->setParameter('endPosition', $endPosition);
        }
        $iterableResult =
            $q->getQuery()
                ->getResult();

        foreach ($iterableResult as $row) {
            $row->setPosition($row->getPosition() + 1);
            $this->getEntityManager()
                ->persist($row);
            $this->getEntityManager()
                ->flush();
        }
    }

    private function decrementOtherEntitiesPosition(
        $excludedEntityId = null,
        $contentId,
        $key,
        $startPosition,
        $endPosition = null
    ) {
        $parameters = [];
        $q =
            $this->createQueryBuilder('c')
                ->where('c.content = :id')
                ->andWhere('c.key = :key')
                ->andWhere('c.position > :position');
        if ($endPosition) {
            $q->andWhere('c.position <= :endPosition');
            $parameters['endPosition'] = $endPosition;
        }
        if ($excludedEntityId) {
            $q->andWhere('c.id != :excludedId');
            $parameters['excludedId'] = $excludedEntityId;
        }

        $parameters = array_merge(
            $parameters,
            [
                'id' => $contentId,
                'key' => $key,
                'position' => $startPosition,
            ]
        );
        $q->setParameters(
            $parameters
        );

        $iterableResult =
            $q->getQuery()
                ->getResult();

        foreach ($iterableResult as $row) {
            $row->setPosition($row->getPosition() - 1);
            $this->getEntityManager()
                ->persist($row);
            $this->getEntityManager()
                ->flush();
        }
    }

    /**
     * @param $entity
     * @param string $positionColumnPrefix
     * @return bool
     */
    public function deleteAndReposition($entity, $positionColumnPrefix = '')
    {
        $existingLink = $this->findBy($entity);

        if (empty($existingLink)) {
            return true;
        }
        $this->decrementOtherEntitiesPosition(
            null,
            $existingLink[0]->getContent()
                ->getId(),
            $existingLink[0]->getKey(),
            $existingLink[0]->getPosition(),
            null
        );

        //dd($existingLink[0]->getContent()->getId());
        //TODO: decrement other fields
        //        $query = $this->query();
        //        if(array_key_exists('content_id', $existingLink)){
        //            $query->where(
        //                [
        //                    'content_id' => $existingLink['content_id'],
        //                    'key' => $existingLink['key'],
        //                ]
        //            );
        //        }
        //
        //        if(array_key_exists('parent_id', $existingLink)){
        //            $query->where('parent_id', $existingLink['parent_id']);
        //        }
        //
        //        $query->where(
        //            $positionColumnPrefix . 'position',
        //            '>',
        //            $existingLink[$positionColumnPrefix . "position"]
        //        )
        //            ->decrement($positionColumnPrefix . 'position');

        $this->getEntityManager()
            ->remove($existingLink[0]);
        $this->getEntityManager()
            ->flush();

        return true;
    }

    public function reposition($id = null, $data)
    {
        $existingData = null;

        $position = $data['position'] ??0;

        if ($id) {
            $existingData = $this->find($id);
            $content = $existingData->getContent();
            $key = $existingData->getKey();
        } else {
            $key = $data['key'];
            $content =
                $this->getEntityManager()
                    ->getRepository(Content::class)
                    ->find($data['content_id']);
        }

        $dataCount = count(
            $this->findBy(
                [
                    'content' => $content->getId(),
                    'key' => $key,
                ]
            )
        );

        $data['position'] = $this->recalculatePosition(
            $position,
            $dataCount,
            $existingData
        );

        if (!($existingData)) {
            $this->incrementOtherEntitiesPosition(
                null,
                $content->getId(),
                $key,
                $data['position'],
                null
            );

        } elseif ($data['position'] > $existingData->getPosition()) {
            $this->decrementOtherEntitiesPosition(
                $id,
                $content->getId(),
                $key,
                $existingData->getPosition(),
                $data['position']
            );
        } elseif ($data['position'] < $existingData->getPosition()) {
            $this->incrementOtherEntitiesPosition(
                $id,
                $existingData->getContent()
                    ->getId(),
                $key,
                $data['position'],
                $existingData->getPosition()
            );
        }
        if (!$existingData) {
            $entity = $this->getEntityName();
            $existingData = new $entity();
        }
        //dd($data);
        $existingData->setKey($data['key']??$existingData->getKey());
        $existingData->setValue($data['value']);
        $existingData->setPosition($data['position']);
        if(array_key_exists('type', $data)) {
            $existingData->setType($data['type']);
        }
        $existingData->setContent($content);

        $this->getEntityManager()
            ->persist($existingData);
        $this->getEntityManager()
            ->flush();

        return $existingData;
    }
}