<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Transformers\BpmTransformer;

class ContentBpmRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()->table(config('railcontent.table_prefix').'content_bpm');
    }

    public function getByContentId($contentId)
    {
        if (empty($contentId)) {
            return [];
        }

        $data = $this->query()
            ->whereIn('content_id', $contentId)
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();

        $this->setPresenter(BpmTransformer::class);
        return $this->parserResult($data);
    }
}