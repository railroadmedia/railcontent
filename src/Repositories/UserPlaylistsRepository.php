<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\JoinClause;

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
     * @param null $term
     * @param string $sort
     * @return array|mixed[]
     */
    public function getUserPlaylist(
        $userId,
        $playlistType,
        $brand = null,
        $limit = null,
        $page = 1,
        $term = null,
        $sort = '-created_at'
    ) {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }

        $orderByDirection = substr($sort, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn = trim($sort, '-');

        $query =
            $this->query()
                ->select(
                    config('railcontent.table_prefix').'user_playlists.*',
                    'c.id as user_playlist_item_id'
                )
                ->selectRaw('IF( pp.id IS NULL, FALSE, TRUE) as  pinned')
                ->leftjoin(
                    config('railcontent.table_prefix').'user_playlist_content as c',
                    function (JoinClause $join) {
                        $join->on(
                            config('railcontent.table_prefix').'user_playlists'.'.id',
                            '=',
                            'c.user_playlist_id'
                        )
                            ->on(
                                'c.position',
                                '=',
                                \DB::raw(
                                    '(select position from '.
                                    config('railcontent.table_prefix').
                                    'user_playlist_content'.
                                    ' where user_playlist_id = c.user_playlist_id order by position asc limit 1)'
                                )
                            );
                    }
                )
                ->leftjoin(
                    config('railcontent.table_prefix').'pinned_playlists as pp',
                    config('railcontent.table_prefix').'user_playlists'.'.id',
                    '=',
                    'pp.playlist_id'
                )
                ->where(config('railcontent.table_prefix').'user_playlists'.'.user_id', $userId)
                ->where(config('railcontent.table_prefix').'user_playlists'.'.brand', $brand)
                ->where('type', $playlistType);
        if ($term) {
            $query->where('name', 'LIKE', '%'.$term.'%');
        }
        if ($limit) {
            $query->limit($limit)
                ->skip(($page - 1) * $limit);
        }

        if (!in_array($orderByColumn, ['name', 'id', 'created_at', 'last_progress','most_recent'])) {
            $orderByColumn = 'id';
        }
        if($orderByColumn == 'name'){
            $query =  $query->orderByRaw(" name asc");
        }
        if($orderByColumn == 'most_recent'){
            $query =
                $query->selectRaw('GREATEST('.config('railcontent.table_prefix').'user_playlists'.'.created_at, COALESCE('.config('railcontent.table_prefix').'user_playlists'.'.updated_at, 0), COALESCE(last_progress, 0)) as datemax ')
                    ->orderByRaw('datemax desc ');
        }else {
            $query =
                $query->orderBy(config('railcontent.table_prefix').'user_playlists.'.$orderByColumn, $orderByDirection);
        }
        $data =
            $query->get()
                ->toArray();

        return $data;
    }

    /**
     * @param $playlistType
     * @param null $brand
     * @param int $page
     * @param null $limit
     * @return array|mixed[]
     */
    public function getPublicPlaylists($playlistType, $brand = null, $page = 1, $limit = null)
    {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }

        $query =
            $this->query()
                ->where('private', false)
                ->where('brand', $brand)
                ->where('type', $playlistType);

        if ($limit) {
            $query->limit($limit)
                ->skip(($page - 1) * $limit);
        }
        $data =
            $query->orderBy('id', 'desc')
                ->get()
                ->toArray();

        return $data;
    }

    /**
     * @param $playlistType
     * @param null $brand
     * @return int
     */
    public function countPublicPlaylists($playlistType, $brand = null)
    {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }

        return $this->query()
            ->where('private', false)
            ->where('brand', $brand)
            ->where('type', $playlistType)
            ->count();
    }

    /**
     * @param $userId
     * @param $playlistType
     * @param null $brand
     * @param null $term
     * @return int
     */
    public function countUserPlaylists($userId, $playlistType, $brand = null, $term = null)
    {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }

        $query =
            $this->query()
                ->where('user_id', $userId)
                ->where('brand', $brand)
                ->where('type', $playlistType);

        if ($term) {
            $query->where('name', 'LIKE', '%'.$term.'%');
        }

        return $query->count();
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

    /**
     * @param $userId
     * @param $playlistType
     * @param null $brand
     * @param null $limit
     * @param int $page
     * @param null $term
     * @param string $sort
     * @return array|mixed[]
     */
    public function getUserPlaylistById(
        $playlistId
    ) {
        $query =
            $this->query()
                ->select(
                    config('railcontent.table_prefix').'user_playlists.*',
                    'c.id as user_playlist_item_id'
                )
                ->leftjoin(
                    config('railcontent.table_prefix').'user_playlist_content as c',
                    function (JoinClause $join) {
                        $join->on(
                            config('railcontent.table_prefix').'user_playlists'.'.id',
                            '=',
                            'c.user_playlist_id'
                        )
                            ->on(
                                'c.position',
                                '=',
                                \DB::raw(
                                    '(select min(position) from '.
                                    config('railcontent.table_prefix').
                                    'user_playlist_content'.
                                    ' where user_playlist_id = c.user_playlist_id)'
                                )
                            );
                    }
                )
                ->where(config('railcontent.table_prefix').'user_playlists.'.'id', $playlistId);

        $data =
            $query->get()
                ->first();

        return $data;
    }
}