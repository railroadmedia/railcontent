<?php

namespace Railroad\Railcontent\Repositories;

use Illuminate\Support\Collection;
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
     * Get the public playlists and the playlists created by the authenticated user
     * @return array
     */
    public function getUserPlaylists($userId)
    {
        return $this->queryTable()
            ->select(ConfigService::$tablePlaylists.'.*')
            ->where(function($query) use ($userId) {
                $query->where(['type' => PlaylistsService::TYPE_PUBLIC])
                    ->orWhere([ConfigService::$tablePlaylists.'.user_id' => $userId]);
            })
            ->where(ConfigService::$tableUserPreference.'.user_id', '=', $userId)
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
        $this->saveTranslation(
            [
                'entity_type' => ConfigService::$tablePlaylists,
                'entity_id' => $playlist,
                'language_id' => 1,
                'value' => $name
            ]
        );
        return $playlist;
    }

    /**
     * Get playlist data and the associated content for the authenticated user
     * @param int $playlistId
     * @param int $userId
     * @return array
     */
    public function getPlaylistWithContent($playlistId, $userId)
    {
        $playlist = $this->queryTable()
            ->select(
                [
                    ConfigService::$tablePlaylists.'.id as playlist_id',
                    ConfigService::$tablePlaylists.'.name as playlist_name',
                    ConfigService::$tablePlaylists.'.type as playlist_type',
                    ConfigService::$tablePlaylists.'.user_id as user_id',
                    'usercontent.content_id as content_id',
                    'usercontent.state as content_state',
                    'usercontent.progress as content_progress'
                ]
            )
            ->leftJoin(ConfigService::$tableUserContentPlaylists.' as usercontentplaylist', 'playlist_id', '=', ConfigService::$tablePlaylists.'.id', 'left outer')
            ->leftJoin(ConfigService::$tableUserContent.' as usercontent', function($join) use ($userId) {
                $join->on('usercontentplaylist.content_user_id', '=', 'usercontent.id')
                    ->where('usercontent.user_id', '=', $userId);
            })
            ->where(ConfigService::$tablePlaylists.'.id', '=', $playlistId)
            ->get();
        return $this->parseAndGetLinkedContent($playlist);
    }

    /** Prepare playlist data
     * @param Collection $playlists
     * @return array
     */
    private function parseAndGetLinkedContent(Collection $playlists)
    {
        $playlistArr = [];
        foreach($playlists as $playlist) {
            $playlistArr[$playlist['playlist_id']] = [
                'id' => $playlist['playlist_id'],
                'name' => $playlist['playlist_name'],
                'type' => $playlist['playlist_type']];
        }

        foreach($playlists as $playlist) {
            if(!is_null($playlist['content_id'])) {
                $playlistArr[$playlist['playlist_id']]['contents'][$playlist['content_id']] = [
                    'id' => $playlist['content_id'],
                    'state' => $playlist['content_state'],
                    'progress' => $playlist['content_progress']
                ];
            }
        }
        return $playlistArr;
    }

    /**
     * @return Builder
     */
    public function queryTable()
    {
        return parent::connection()->table(ConfigService::$tablePlaylists)
            ->leftJoin(ConfigService::$tableTranslations, function($join) {
                $join->on(ConfigService::$tableTranslations.'.entity_id', '=', ConfigService::$tablePlaylists.'.id')
                    ->where(ConfigService::$tableTranslations.'.entity_type', ConfigService::$tablePlaylists);
            })
            ->leftJoin(ConfigService::$tableUserPreference, ConfigService::$tableTranslations.'.language_id', '=', ConfigService::$tableUserPreference.'.language_id');
    }

    /**
     * @return Builder
     */
    public function queryUserPlaylistTable()
    {
        return parent::connection()->table(ConfigService::$tableUserContentPlaylists);
    }
}