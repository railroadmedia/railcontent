<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Transformers\KeyTransformer;

class ContentKeyRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()
            ->table(config('railcontent.table_prefix').'content_keys');
    }

    public function getByContentIds($contentId)
    {
        if (empty($contentId)) {
            return [];
        }

        $data =
            $this->query()
                ->whereIn('content_id', $contentId)
                ->orderBy('position', 'asc')
                ->get()
                ->toArray();

        $this->setPresenter(KeyTransformer::class);

        return $this->parserResult($data);
    }
}