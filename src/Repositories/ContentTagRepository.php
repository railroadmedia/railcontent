<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Transformers\TagTransformer;

class ContentTagRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()
            ->table(config('railcontent.table_prefix').'content_tags');
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

        $this->setPresenter(TagTransformer::class);

        return $this->parserResult($data);
    }
}