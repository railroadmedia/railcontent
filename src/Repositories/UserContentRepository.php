<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/14/2017
 * Time: 4:37 PM
 */

namespace Railroad\Railcontent\Repositories;


use Railroad\Railcontent\Services\ConfigService;

class UserContentRepository extends RepositoryBase
{
    public function startContent($contentId, $userId, $state)
    {
        $userContentId = $this->queryTable()->insertGetId(
            [
                'content_id' => $contentId,
                'user_id' => $userId,
                'state' => $state,
                'progress' => 0
            ]
        );

        return $userContentId;
    }

    public function updateUserContent($contentId, $userId, $data)
    {
        $userContentId = $this->queryTable()->where(['content_id' => $contentId,
            'user_id' => $userId])->update($data);

        return $userContentId;
    }

    public function queryTable()
    {
        return parent::connection()->table(ConfigService::$tableUserContent);
    }
}