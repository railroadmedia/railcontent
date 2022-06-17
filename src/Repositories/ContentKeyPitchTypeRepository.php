<?php

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Transformers\KeyPitchTypeTransformer;

class ContentKeyPitchTypeRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()
            ->table(config('railcontent.table_prefix').'content_key_pitch_types');
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

        $this->setPresenter(KeyPitchTypeTransformer::class);

        return $this->parserResult($data);
    }
}