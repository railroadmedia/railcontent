<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Transformers\TopicTransformer;

class ContentTopicRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()
            ->table(config('railcontent.table_prefix').'content_topics');
    }

    public function getByContentIds($contentIds)
    {
        if (empty($contentIds)) {
            return [];
        }

        $data =
            $this->query()
                ->whereIn('content_id', $contentIds)
                ->orderBy('position', 'asc')
                ->get()
                ->toArray();

        $this->setPresenter(TopicTransformer::class);

        return $this->parserResult($data);
    }
}