<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/21/2017
 * Time: 9:11 AM
 */

namespace Railroad\Railcontent\Repositories;

use Railroad\Railcontent\Services\ConfigService;

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
     * @return Builder
     */
    public function queryUserPlaylistTable()
    {
        return parent::connection()->table(ConfigService::$tableUserContentPlaylists);
    }
}