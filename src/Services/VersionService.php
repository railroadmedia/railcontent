<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\ContentVersionRepository;

class VersionService
{
    // todo: revamp this class

    private $versionRepository;
    private $contentRepository;
    private $request;

    public function __construct(
        ContentVersionRepository $versionRepository,
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
        $userId = $this->request->user()->id ?? null;

        //get content
        $content = $this->contentRepository->getById($contentId);

        $versionContentId =
            $this->versionRepository->create(
                [
                    'content_id' => $contentId,
                    'author_id' => $userId,
                    'state' => '',
                    'data' => serialize($content),
                    'saved_on' => Carbon::now()->toDateTimeString(),
                ]
            );

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
        $hash = 'version_'. CacheHelper::getKey($versionId);
        $results = Cache::store('redis')->rememberForever($hash, function () use ($hash, $versionId) {
            $results = $this->versionRepository->getOldContent($versionId);
            return $results;
        });

        return $results;
    }
}