<?php

namespace Railroad\Railcontent\Repositories;

class UserPlaylistsRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()->table(config('railcontent.table_prefix').'user_playlists');
    }

    /**
     * @param $userId
     * @param $playlistType
     * @param null $brand
     * @return array|mixed[]
     */
    public function getUserPlaylist($userId, $playlistType, $brand=null)
    {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }

        $data = $this->query()
            ->where('user_id', $userId)
            ->where('brand', $brand)
            ->where('type', $playlistType)
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        return $data;
    }
}