<?php

namespace Railroad\Railcontent\Services;


use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\VersionRepository;
use Illuminate\Http\Request;

class VersionService
{
    private $versionRepository, $contentRepository;
    private $request;

    public function __construct (VersionRepository $versionRepository, Request $request, ContentRepository $contentRepository)
    {
        $this->versionRepository = $versionRepository;
        $this->contentRepository = $contentRepository;
        $this->request = $request;
    }

    public function store($contentId)
    {
        $userId = ($this->versionRepository->getAuthenticatedUserId($this->request));
        $content = $this->contentRepository->getById($contentId);

        $versionContentId = $this->versionRepository->store($contentId, $userId, '', serialize($content)) ;

        return $versionContentId;
    }
}