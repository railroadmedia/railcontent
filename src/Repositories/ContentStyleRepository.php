<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Transformers\StyleTransformer;

class ContentStyleRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()->table(config('railcontent.table_prefix').'content_styles');
    }

    public function getByContentIds($contentId)
    {
        if (empty($contentId)) {
            return [];
        }

        $data = $this->query()
            ->whereIn('content_id', $contentId)
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();

       $this->setPresenter(StyleTransformer::class);
        return $this->parserResult($data);
    }
}