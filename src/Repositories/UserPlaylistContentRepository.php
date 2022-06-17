<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Transformers\ContentTransformer;

class UserPlaylistContentRepository extends RepositoryBase
{
    /**
     * @var ContentDatumRepository
     */
    private $datumRepository;
    /**
     * @var ContentInstructorRepository
     */
    private $contentInstructorRepository;

    /**
     * @param ContentDatumRepository $datumRepository
     * @param ContentInstructorRepository $contentInstructorRepository
     */
    public function __construct(
        ContentDatumRepository $datumRepository,
        ContentInstructorRepository $contentInstructorRepository
    ) {
        parent::__construct();

        $this->datumRepository = $datumRepository;
        $this->contentInstructorRepository = $contentInstructorRepository;
    }

    public function query()
    {
        return $this->connection()
            ->table(config('railcontent.table_prefix').'user_playlist_content');
    }

    /**
     * @param $playlistId
     * @param array $contentType
     * @param null $limit
     * @param int $skip
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getUserPlaylistContents($playlistId, $contentType = [], $limit = null, $skip = 0)
    {
        $query =
            $this->query()
                ->select(config('railcontent.table_prefix').'content.*')
                ->join(
                    config('railcontent.table_prefix').'content',
                    config('railcontent.table_prefix').'user_playlist_content.content_id',
                    '=',
                    config('railcontent.table_prefix').'content.id'
                )
                ->where('user_playlist_id', $playlistId);
        if (!empty($contentType)) {
            $query->whereIn(config('railcontent.table_prefix').'content.type', $contentType);
        }

        if ($limit) {
            $query->limit($limit)
                ->skip($skip);
        }

        $contentRows =
            $query->orderBy(config('railcontent.table_prefix').'user_playlist_content.id', 'desc')
                ->get()
                ->toArray();

        $extraData = $this->geExtraDataInOldStyle(['data', 'instructor', 'video'], $contentRows);

        $parser = $this->setPresenter(ContentTransformer::class);
        $parser->presenter->addParam($extraData);

        return $this->parserResult($contentRows);
    }

    /**
     * @param $playlistId
     * @param array $contentType
     * @return int
     */
    public function countUserPlaylistContents($playlistId, $contentType = [])
    {
        $query =
            $this->query()
                ->where('user_playlist_id', $playlistId);
        if (!empty($contentType)) {
            $query->join(
                config('railcontent.table_prefix').'content',
                config('railcontent.table_prefix').'user_playlist_content.content_id',
                '=',
                config('railcontent.table_prefix').'content.id'
            )
                ->whereIn(config('railcontent.table_prefix').'content.type', $contentType);
        }

        return $query->count();
    }

    /**
     * @param $playlistId
     * @param $contentId
     * @return array|mixed[]
     */
    public function getByPlaylistIdAndContentId($playlistId, $contentId)
    {
        return $this->query()
            ->where('user_playlist_id', $playlistId)
            ->where('content_id', $contentId)
            ->get()
            ->toArray();
    }
}