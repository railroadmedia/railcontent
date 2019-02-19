<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\Version;
use Railroad\Railcontent\Helpers\CacheHelper;

class VersionService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    private $versionRepository;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    private $contentRepository;

    /**
     * @var Request
     */
    private $request;

    public function __construct(
        Request $request,
        EntityManager $entityManager
    )
    {
        $this->entityManager = $entityManager;

        $this->versionRepository = $this->entityManager->getRepository(Version::class);
        $this->contentRepository = $this->entityManager->getRepository(Content::class);
        $this->request = $request;
    }

    /**
     * Call store method that save a content version in the database
     *
     * @param integer $contentId
     * @return int
     */
    public function store($contentId)
    {
        //get authenticated user id
        $userId = $this->request->user()->id ?? null;

        //get content
        $content = $this->contentRepository->find($contentId);

        $versionContent = new Version();
        $versionContent->setData(serialize($content));
        $versionContent->setAuthorId($userId);
        $versionContent->setContent($content);

        $this->entityManager->persist($versionContent);
        $this->entityManager->flush();

        return $versionContent;
    }

    /**
     * Get a version of content from database
     *
     * @param integer $versionId
     * @return array
     */
    public function get($versionId)
    {
        $hash = 'version_' . CacheHelper::getKey($versionId);
        $results =
            Cache::store(ConfigService::$cacheDriver)
                ->rememberForever(
                    $hash,
                    function () use ($hash, $versionId) {
                        $results = $this->versionRepository->find($versionId);
                        return $results;
                    }
                );

        return $results;
    }
}