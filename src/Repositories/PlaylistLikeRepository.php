<?php

namespace Railroad\Railcontent\Repositories;

class PlaylistLikeRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()
            ->table(config('railcontent.table_prefix').'playlist_likes');
    }

    /**
     * @param $userId
     * @param null $brand
     * @param null $limit
     * @param int $page
     * @return array|mixed[]
     */
    public function getLikedPlaylist($userId, $brand = null, $limit = null, $page = 1)
    {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }

        $query =
            $this->query()
                ->join(
                    config('railcontent.table_prefix').'user_playlists',
                    config('railcontent.table_prefix').'playlist_likes.playlist_id',
                    '=',
                    config('railcontent.table_prefix').'user_playlists.id'
                )
                ->where(config('railcontent.table_prefix').'playlist_likes.user_id', $userId)
                ->where(config('railcontent.table_prefix').'playlist_likes.brand', $brand);

        if ($limit) {
            $query->limit($limit)
                ->skip(($page - 1) * $limit);
        }

        $data =
            $query->orderBy(config('railcontent.table_prefix').'playlist_likes.created_at', 'desc')
                ->get()
                ->toArray();

        return $data;
    }

    public function countLikedPlaylist($userId, $brand = null)
    {
        if (!$brand) {
            $brand = config('railcontent.brand');
        }

        return $this->query()
            ->where(config('railcontent.table_prefix').'playlist_likes.user_id', $userId)
            ->where(config('railcontent.table_prefix').'playlist_likes.brand', $brand)
            ->count();
    }
}