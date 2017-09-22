<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/21/2017
 * Time: 9:11 AM
 */

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\PlaylistsService;

class PlaylistsRepository extends RepositoryBase
{
    /**
     * Save a new record in railcontent_user_content_playlists table
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
     * Get user's playlists and public playlists
     * @return mixed
     */
    public function getUserPlaylists($userId)
    {
        return $this->queryTable()->where(['type' => PlaylistsService::TYPE_PUBLIC])
            ->orWhere(['user_id' => $userId])
            ->get()->toArray();
    }

    /**
     * Create a new playlist
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
                'user_id' => $userId
            ]
        );
        return $playlist;
    }

    /**
     * @return Builder
     */
    public function queryTable()
    {
        return parent::connection()->table(ConfigService::$tablePlaylists);
    }

    /**
     * @return Builder
     */
    public function queryUserPlaylistTable()
    {
        return parent::connection()->table(ConfigService::$tableUserContentPlaylists);
    }
}