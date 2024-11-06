<?php

namespace App\Modules\RailTracker\Repositories;

use Carbon\Carbon;

class ContentLastEngagedRepository extends TrackerRepositoryBase
{
    /**
     * @param $userId
     * @param $contentId
     * @param null $parentPlaylistId
     * @param null $parentContentId
     * @return \Illuminate\Support\Collection
     */
    public function insertOrUpdate($userId, $contentId, $parentPlaylistId = null, $parentContentId = null)
    {
        $this->query()
            ->updateOrInsert([
                                 'user_id' => $userId,
                                 'parent_playlist_id' => $parentPlaylistId,
                                 'parent_content_id' => $parentContentId,
                             ], [
                                 'content_id' => $contentId,
                                 'created_at' => Carbon::now()
                                     ->toDateTimeString(),
                                 'updated_at' => Carbon::now()
                                     ->toDateTimeString(),
                             ]);

        return $this->query()
            ->where([
                        'user_id' => $userId,
                        'parent_playlist_id' => $parentPlaylistId,
                        'parent_content_id' => $parentContentId,
                    ])
            ->get();
    }

    /**
     * @param $userId
     * @param null $parentPlaylistId
     * @param null $parentContentId
     * @return int
     */
    public function delete($userId, $parentPlaylistId = null, $parentContentId = null)
    {
        return $this->query()
            ->where([
                        'user_id' => $userId,
                        'parent_playlist_id' => $parentPlaylistId,
                        'parent_content_id' => $parentContentId,
                    ])
            ->delete();
    }

    public function getLastEngagedContentForPlaylistId(int $userId, int $parentPlaylistId): null|object
    {
        return $this->query()
            ->where([
                        'user_id' => $userId,
                        'parent_playlist_id' => $parentPlaylistId,
                    ])
            ->first();
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    private function query()
    {
        $contentLastEngagedTable =
            config('railtracker.table_prefix_media_playback_tracking').
            config('railtracker.content_last_engaged_table', 'content_last_engaged');
        return DB::table($contentLastEngagedTable);
    }

}
