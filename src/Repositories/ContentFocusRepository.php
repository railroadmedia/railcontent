<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Transformers\FocusTransformer;

class ContentFocusRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()->table(config('railcontent.table_prefix').'content_focus');
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

        $this->setPresenter(FocusTransformer::class);
        return $this->parserResult($data);
    }
}