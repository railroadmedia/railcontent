<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use Illuminate\Support\Facades\DB;

class RecalculatePlaylistDuration extends Command
{

    protected $name = 'RecalculatePlaylistDuration';
    protected $signature = 'RecalculatePlaylistDuration {playlistId}';
    protected $description = 'Recalculate playlist duration';

    public function handle()
    {
        $playlistId = $this->argument('playlistId');

        $durations =
            DB::table('railcontent_content_fields')
                ->selectRaw(
                    'sum(f2.value) as duration, railcontent_user_playlist_content.user_playlist_id as playlist_id'
                )
                ->join(
                    'railcontent_content',
                    'railcontent_content_fields.value',
                    '=',
                    'railcontent_content.id'
                )
                ->join(
                    'railcontent_content_fields as f2',
                    'railcontent_content.id',
                    '=',
                    'f2.content_id'
                )

                ->join(
                    'railcontent_user_playlist_content',
                    'railcontent_content_fields.content_id',
                    '=',
                    'railcontent_user_playlist_content.content_id'
                )
                ->whereIn('railcontent_user_playlist_content.user_playlist_id', [$playlistId])
                ->where('railcontent_content_fields.key', '=', 'video')
                ->where('f2.key', '=', 'length_in_seconds')
                ->groupBy('railcontent_user_playlist_content.user_playlist_id')
                ->orderBy('railcontent_user_playlist_content.user_playlist_id', 'asc')
                ->get();
        $videoDurations =
            (array_combine(
                $durations->pluck('playlist_id')
                    ->toArray(),
                $durations->pluck('duration')
                    ->toArray()
            ));

        $songDuration =
            DB::table('railcontent_user_playlist_content')
                ->selectRaw(
                    'sum(railcontent_content.length_in_seconds) as duration,  railcontent_user_playlist_content.user_playlist_id as playlist_id'
                )
                ->join(
                    'railcontent_content_hierarchy',
                    'railcontent_content_hierarchy.parent_id',
                    '=',
                    'railcontent_user_playlist_content.content_id'
                )
                ->join(
                    'railcontent_content',
                    'railcontent_content_hierarchy.child_id',
                    '=',
                    'railcontent_content.id'
                )
                ->whereIn('railcontent_user_playlist_content.user_playlist_id', [$playlistId])
                ->where('railcontent_content.type', '=', 'assignment')
                ->groupBy('railcontent_user_playlist_content.user_playlist_id')
                ->get();

        $songsDurations =
            (array_combine(
                $songDuration->pluck('playlist_id')
                    ->toArray(),
                $songDuration->pluck('duration')
                    ->toArray()
            ));

        $playlistDuration =
            \DB::table('railcontent_user_playlists')
                ->where('railcontent_user_playlists.id', '=', $playlistId)
                ->update([
                             'duration' => ($videoDurations[$playlistId] ?? 0) + ($songsDurations[$playlistId] ?? 0),
                         ]);

        $this->info('Done.');
    }
}
