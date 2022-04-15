<?php

namespace Railroad\Railcontent\Repositories;

class ContentStyleRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()->table(config('railcontent.table_prefix').'content_styles');
    }

    public function getByContentId($contentId)
    {
        if (empty($contentId)) {
            return [];
        }

        return $this->query()
            ->where('content_id', $contentId)
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();
    }
}