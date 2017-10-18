<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

class VersionRepository extends RepositoryBase
{

    /**
     * Insert into railcontent_content_version the old content version
     *
     * @param integer $contentId
     * @param integer|null $authorId
     * @param string $state
     * @param $data
     * @return int
     */
    public function store($contentId, $authorId, $state, $data)
    {
        $contentVersionId = $this->queryTable()->insertGetId(
            [
                'content_id' => $contentId,
                'author_id' => $authorId,
                'state' => $state,
                'data' => $data,
                'saved_on' => Carbon::now()->toDateTimeString(),
            ]
        );

        return $contentVersionId;
    }

    /**
     * @return Builder
     */
    public function queryTable()
    {
        return $this->connection()->table(ConfigService::$tableVersions);
    }

    /**
     * Return content version from database, based on version id
     *
     * @param integer $versionId
     * @return mixed
     */
    public function get($versionId)
    {
        $content = $this->queryTable()->where('id', $versionId)->get()->first();

        return $content;
    }
}