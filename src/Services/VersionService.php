<?php

namespace Railroad\Railcontent\Services;

use Illuminate\Http\Request;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\VersionRepository;

class VersionService
{
    // todo: revamp this class

    private $versionRepository;
    private $contentRepository;
    private $request;

    public function __construct(
        VersionRepository $versionRepository,
        Request $request,
        ContentRepository $contentRepository
    ) {
        $this->versionRepository = $versionRepository;
        $this->contentRepository = $contentRepository;
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
        $userId = ($this->versionRepository->getAuthenticatedUserId($this->request));

        //get content
        $content = $this->search->getById($contentId);

        $versionContentId = $this->versionRepository->store($contentId, $userId, '', serialize($content));

        return $versionContentId;
    }

    /**
     * Get a version of content from database
     *
     * @param integer $versionId
     * @return array
     */
    public function get($versionId)
    {
        return $this->versionRepository->getOldContent($versionId);
    }
}