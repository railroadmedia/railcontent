<?php

namespace Railroad\Railcontent\Repositories;

class UserPlaylistsRepository extends RepositoryBase
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return $this->connection()
            ->table(config('railcontent.table_prefix').'user_playlists');
    }

    /**
     * @param $userId
     * @param $playlistType
     * @param null $brand
     * @param null $limit
     * @param int $page
     * @return array|mixed[]
     */
    public function getUserPlaylist($userId, $playlistType, $brand = null, $limit = null, $page = 1)
    {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }

        $query =
            $this->query()
                ->where('user_id', $userId)
                ->where('brand', $brand)
                ->where('type', $playlistType)
                ->orderBy('id', 'desc');

        if ($limit) {
            $query->limit($limit)
                ->skip(($page - 1) * $limit);
        }

        $data =
            $query->get()
                ->toArray();

        return $data;
    }

    /**
     * @param $playlistType
     * @param null $brand
     * @return array|mixed[]
     */
    public function getPublicPlaylists($playlistType, $brand = null)
    {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }

        $data =
            $this->query()
                ->where('private', false)
                ->where('brand', $brand)
                ->where('type', $playlistType)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

        return $data;
    }

    /**
     * @param $userId
     * @param $playlistType
     * @param null $brand
     * @return int
     */
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

    /**
     * @param $term
     * @param $page
     * @param null $limit
     * @return array|mixed[]
     */
    public function searchPlaylist($term, $page, $limit = null)
    {
        $query =
            $this->query()
                ->where('name', 'LIKE', '%'.$term.'%')
                ->where('user_id', '=', auth()->id())
                ->where('brand', config('railcontent.brand'));

        if ($limit) {
            $query->limit($limit)
                ->skip(($page - 1) * $limit);
        }

        $data =
            $query->get()
                ->toArray();

        return $data;
    }

    /**
     * @param $term
     * @return int
     */
    public function countTotalSearchResults($term)
    {
        return $this->query()
            ->where('name', 'LIKE', '%'.$term.'%')
            ->where('user_id', '=', auth()->id())
            ->where('brand', config('railcontent.brand'))
            ->count();
    }
}