<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Transformers\TopicTransformer;
use Railroad\Railcontent\Transformers\VideoTransformer;

class ContentVideoRepository extends RepositoryBase
{
    private $datumRepository;

    public function __construct(
        ContentDatumRepository $datumRepository
    ) {
        parent::__construct();

        $this->datumRepository = $datumRepository;
    }

    public function query()
    {
        return $this->connection()->table(config('railcontent.table_prefix').'content');
    }

    public function getByContentIds($contentIds, $key = 'video')
    {
        if (empty($contentIds)) {
            return [];
        }

        $data =
            $this->query()
                ->select(config('railcontent.table_prefix').'content.id as content_id', 'videoRow.*')
                ->join(
                    config('railcontent.table_prefix').'content as videoRow',
                    config('railcontent.table_prefix').'content.'.$key,
                    '=',
                    'videoRow.id'
                )
                ->whereIn(config('railcontent.table_prefix').'content.id', $contentIds)
                ->get()
                ->toArray();

        $parser = $this->setPresenter(VideoTransformer::class);

        $contentDatumRows = $this->datumRepository->getByContentIds(array_column($data, 'id'));

        $parser->presenter->addParam(['data' => ContentHelper::groupArrayBy($contentDatumRows, 'content_id')]);

        return $this->parserResult($data);
    }

    public function getContentWithExternalVideoId($videoId)
    {
        $results =  $this->query()
            ->select('lesson.id as content_id', 'lesson.*')
            ->join(
                config('railcontent.table_prefix').'content as lesson',
                'lesson.video',
                '=',
                config('railcontent.table_prefix').'content.id'
            )
            ->where(config('railcontent.table_prefix').'content.vimeo_video_id','=', $videoId)
            ->orWhere(config('railcontent.table_prefix').'content.youtube_video_id','=', $videoId)
            ->get();

        return $results;
    }
}
