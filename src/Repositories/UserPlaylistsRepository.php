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
    public function getUserPlaylist($userId, $playlistType, $brand=null, $limit = null, $page = 1)
    {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }

        $query = $this->query()
            ->where('user_id', $userId)
            ->where('brand', $brand)
            ->where('type', $playlistType)
            ->orderBy('id', 'desc');

        if ($limit) {
            $query->limit($limit)
                ->skip(($page - 1) * $limit);
        }

            $data = $query->get()
            ->toArray();

        return $data;
    }

    public function getPublicPlaylists($playlistType, $brand=null)
    {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }

        $data = $this->query()
            ->where('private', false)
            ->where('brand', $brand)
            ->where('type', $playlistType)
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        return $data;
    }

    public function countUserPlaylists($userId, $playlistType, $brand = null)
    {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }

        return $this->query()
            ->where('user_id', $userId)
            ->where('brand', $brand)
            ->where('type', $playlistType)
            ->count();
    }
}