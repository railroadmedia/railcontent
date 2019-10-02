<?php

namespace Railroad\Railcontent\Transformers;

use League\Fractal\TransformerAbstract;
use Railroad\Railcontent\Entities\UserContentProgress;

class UserContentProgressOldStructureTransformer extends TransformerAbstract
{
    /**
     * @param UserContentProgress $userContentProgress
     * @return array
     */
    public function transform(UserContentProgress $userContentProgress)
    {
        return [
            $userContentProgress->getUser()
                ->getId() => [
                'id' => $userContentProgress->getId(),
                'content_id' => $userContentProgress->getContent()
                    ->getId(),
                'user_id' => $userContentProgress->getUser()
                    ->getId(),
                'state' => $userContentProgress->getState(),
                'progress_percent' => $userContentProgress->getProgressPercent(),
                'updated_on' => ($userContentProgress->getUpdatedOn()) ?
                    $userContentProgress->getUpdatedOn()
                        ->toDateTimeString() : null,
            ],
        ];
    }
}