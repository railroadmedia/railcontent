<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\JoinClause;

class PinnedPlaylistsRepository extends RepositoryBase
{
    public function query()
    {
        return $this->connection()->table(config('railcontent.table_prefix').'pinned_playlists');
    }

    public function getMyPinnedPlaylists()
    {
        $brand = config('railcontent.brand');

        $query = $this->query()
            ->join(
                config('railcontent.table_prefix').'user_playlists',
                function (JoinClause $join) {
                    $join->on(
                        config('railcontent.table_prefix').'pinned_playlists' . '.playlist_id',
                        '=',
                        config('railcontent.table_prefix').'user_playlists' . '.id'
                    );
                }
            )
            ->where(config('railcontent.table_prefix').'pinned_playlists.user_id', auth()->id())
            ->where(config('railcontent.table_prefix').'pinned_playlists.brand', $brand)
            ->orderBy(config('railcontent.table_prefix').'pinned_playlists.created_at', 'desc');


        $data = $query->get()
            ->toArray();

        return $data;
    }

    public function getMyPinnedPlaylist($playlistId)
    {
        $brand = config('railcontent.brand');

        $query = $this->query()
            ->select(config('railcontent.table_prefix').'pinned_playlists.id')
            ->join(
                config('railcontent.table_prefix').'user_playlists',
                function (JoinClause $join) {
                    $join->on(
                        config('railcontent.table_prefix').'pinned_playlists' . '.playlist_id',
                        '=',
                        config('railcontent.table_prefix').'user_playlists' . '.id'
                    );
                }
            )
            ->where(config('railcontent.table_prefix').'pinned_playlists.user_id', auth()->id())
            ->where(config('railcontent.table_prefix').'user_playlists.brand', $brand)
            ->where(config('railcontent.table_prefix').'pinned_playlists.playlist_id', $playlistId);

        $data = $query->get();

        return $data;
    }
}