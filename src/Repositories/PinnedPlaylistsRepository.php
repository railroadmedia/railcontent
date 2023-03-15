<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\JoinClause;

class PinnedPlaylistsRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()
            ->table(config('railcontent.table_prefix').'pinned_playlists');
    }

    /**
     * @return array|mixed[]
     */
    public function getMyPinnedPlaylists()
    {
        $brand = config('railcontent.brand');

        $query =
            $this->query()
                ->select(
                    config('railcontent.table_prefix').'user_playlists.*',
                    config('railcontent.table_prefix').'user_playlist_content.id as user_playlist_item_id'
                )
                ->join(config('railcontent.table_prefix').'user_playlists', function (JoinClause $join) {
                    $join->on(
                        config('railcontent.table_prefix').'pinned_playlists'.'.playlist_id',
                        '=',
                        config('railcontent.table_prefix').'user_playlists'.'.id'
                    );
                })
                ->leftjoin(config('railcontent.table_prefix').'user_playlist_content', function (JoinClause $join) {
                    $join->on(
                        config('railcontent.table_prefix').'pinned_playlists'.'.playlist_id',
                        '=',
                        config('railcontent.table_prefix').'user_playlist_content'.'.user_playlist_id'
                    )
                        ->where(config('railcontent.table_prefix').'user_playlist_content.position', '=', 1);
                })
                ->where(config('railcontent.table_prefix').'pinned_playlists.user_id', auth()->id())
                ->where(config('railcontent.table_prefix').'pinned_playlists.brand', $brand)
                ->orderBy(config('railcontent.table_prefix').'pinned_playlists.created_at', 'desc');

        $data =
            $query->get()
                ->toArray();

        return $data;
    }
}