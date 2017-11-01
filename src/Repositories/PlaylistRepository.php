<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

class PlaylistRepository extends RepositoryBase
{
    /**
     * @param integer $userId
     * @param string $privacy
     * @return array
     */
    public function getByUserIdAndPrivacy($userId, $privacy)
    {
        return $this->query()
            ->where(['user_id' => $userId, 'privacy' => $privacy])
            ->where('brand', ConfigService::$brand)
            ->get()->toArray();
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->connection()->table(ConfigService::$tablePlaylists);
    }
}