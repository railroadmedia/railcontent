<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\EntityManager;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Events\ContentDatumCreated;
use Railroad\Railcontent\Events\ContentDatumDeleted;
use Railroad\Railcontent\Events\ContentDatumUpdated;
use Railroad\Railcontent\Repositories\ContentDatumRepository;

class ContentDatumService
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var ContentDatumRepository
     */
    private $datumRepository;

    /**
     * DatumService constructor.
     *
     * @param ContentDatumRepository $datumRepository
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->datumRepository = $this->entityManager->getRepository(ContentData::class);
    }

    /**
     * @param integer $id
     * @return array
     */
    public function get($id)
    {
        return $this->datumRepository->find($id);
    }

    /**
     * @param array $contentIds
     * @return array
     */
    public function getByContentIds(array $contentIds)
    {
        return $this->datumRepository->createQueryBuilder('d')
            ->where('content IN (:contents)')
            ->setParameter('contents', $contentIds)
            ->getQuery()
            ->getResult();
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
        $contentRepository = $this->entityManager->getRepository(Content::class);
        $content = $contentRepository->find($contentId);

        $position = $this->recalculatePosition($key, $position, $content);

        $contentDatum = new ContentData();
        $contentDatum->setKey($key);
        $contentDatum->setValue($value);
        $contentDatum->setContent($content);
        $contentDatum->setPosition($position);

        $this->entityManager->persist($contentDatum);
        $this->entityManager->flush();

        //call the event that save a new content version in the database
        event(new ContentDatumCreated($contentId));

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        return $this->get($contentDatum->getId());
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
        if (count($data) == 0) {
            return $datum;
        }

        $position = $this->recalculatePosition(
            $data['data']['attributes']['key'] ?? $datum->getKey(),
            $data['data']['attributes']['position'] ?? $datum->getPosition(),
            $datum->getContent()
        );

        $datum->setKey($data['data']['attributes']['key'] ?? $datum->getKey());
        $datum->setValue($data['data']['attributes']['value'] ?? $datum->getValue());
        $datum->setPosition($position ?? $datum->getPosition());

        $this->entityManager->persist($datum);
        $this->entityManager->flush();

        //save a content version
        event(
            new ContentDatumUpdated(
                $datum->getContent()
                    ->getId()
            )
        );

        $this->entityManager->getCache()
            ->evictEntity(
                Content::class,
                $datum->getContent()
                    ->getId()
            );

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
        $this->entityManager->remove($datum);
        $this->entityManager->flush();

        //save a content version 
        event(
            new ContentDatumDeleted(
                $datum->getContent()
                    ->getId()
            )
        );

        //delete cache associated with the content id
        $this->entityManager->getCache()
            ->evictEntity(
                Content::class,
                $datum->getContent()
                    ->getId()
            );

        return true;
    }

    /**
     * @param $key
     * @param $position
     * @param $content
     * @return int
     */
    private function recalculatePosition($key, $position, $content)
    : int {
        $otherDatumNr = count(
            $this->datumRepository->findBy(
                [
                    'content' => $content->getId(),
                    'key' => $key,
                ]
            )
        );

        if (!$position || ($position > $otherDatumNr)) {
            $position = -1;
        }

        if ($position < -1) {
            $position = 0;
        }

        return $position;
    }
}