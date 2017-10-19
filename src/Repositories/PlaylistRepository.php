<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\PlaylistsService;

class PlaylistRepository extends RepositoryBase
{
    /**
     * Save a new record in railcontent_user_content_playlists table
     *
     * @param int $contentId
     * @param int $playlistId
     * @return int - the record id
     */
    public function addToPlaylist($contentId, $playlistId)
    {
        $userPlaylistId = $this->queryUserPlaylistTable()->insertGetId(
            [
                'content_user_id' => $contentId,
                'playlist_id' => $playlistId
            ]
        );

        return $userPlaylistId;
    }

    /**
     * @return Builder
     */
    public function queryUserPlaylistTable()
    {
        return $this->connection()->table(ConfigService::$tableUserContentPlaylists);
    }

    /**
     * Get the public playlists and the playlists created by the authenticated user
     *
     * @return array
     */
    public function getUserPlaylists($userId)
    {
        return $this->queryTable()
            ->select(
                ConfigService::$tablePlaylists . '.*'
            )
            ->where(
                function ($query) use ($userId) {
                    $query->where(['type' => PlaylistsService::TYPE_PUBLIC])
                        ->orWhere([ConfigService::$tablePlaylists . '.user_id' => $userId]);
                }
            )
            ->where('brand', ConfigService::$brand)
            ->get()->toArray();
    }

    /**
     * @return Builder
     */
    public function queryTable()
    {
        return $this->connection()->table(ConfigService::$tablePlaylists);
    }

    /**
     * Create a new playlist
     *
     * @param string $name
     * @param int $userId
     * @param string $type
     * @return int
     */
    public function store($name, $userId, $type)
    {
        $playlist = $this->queryTable()->insertGetId(
            [
                'name' => $name,
                'type' => $type,
                'user_id' => $userId,
                'brand' => ConfigService::$brand
            ]
        );

        return $playlist;
    }
}