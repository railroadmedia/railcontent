<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class MigrateUserPlaylistToV2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MigrateUserPlaylistToV2 {brand=all} {startingUserId=0} {endingUserId=9999999} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate user playlists to the new v2 structure';

    private DatabaseManager $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(
        DatabaseManager $databaseManager
    ) {
        parent::__construct();

        $this->databaseManager = $databaseManager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dbConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();
        $pdo = $dbConnection->getPdo();
        $pdo->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');

        if (Schema::connection(config('railcontent.database_connection_name'))
            ->hasColumn(
                'railcontent_user_playlists',
                'migrated'
            )) {
            Schema::connection(config('railcontent.database_connection_name'))
                ->table('railcontent_user_playlists', function (Blueprint $table) {
                    $table->dropColumn('migrated');
                });
        }

        Schema::connection(config('railcontent.database_connection_name'))
            ->table('railcontent_user_playlists', function (Blueprint $table) {
                $table->boolean('migrated')
                    ->default(false);
            });

        $start = microtime(true);

        $this->info(
            'Migrate user playlists command starting :::: '.
            Carbon::now()
                ->toDateTimeString()
        );

        //delete items that do not have the 'published' status
        $del =
            $dbConnection->table(config('railcontent.table_prefix').'user_playlist_content')
                ->join(
                    'railcontent_content',
                    'railcontent_content.id',
                    '=',
                    config('railcontent.table_prefix').'user_playlist_content.content_id'
                )
                ->whereNot('railcontent_content.status', '=', 'published')
                ->delete();

        //delete instructor items from playlist
        $instructors =
            $dbConnection->table(config('railcontent.table_prefix').'user_playlist_content')
                ->join(
                    'railcontent_content',
                    'railcontent_content.id',
                    '=',
                    config('railcontent.table_prefix').'user_playlist_content.content_id'
                )
                ->where('railcontent_content.type', '=', 'instructor')
                ->delete();

        $this->info(
            'Deleted '.
            $del.
            ' items that do not have the published status '.
            Carbon::now()
                ->toDateTimeString()
        );

        $this->info(
            'Deleted '.
            $instructors.
            ' instructors items '.
            Carbon::now()
                ->toDateTimeString()
        );

        //delete empty playlists
        $emptyPlaylists =
            $dbConnection->table('railcontent_user_playlists')
                ->leftJoin(
                    'railcontent_user_playlist_content',
                    'railcontent_user_playlists.id',
                    '=',
                    'railcontent_user_playlist_content.user_playlist_id'
                )
                ->whereNull('railcontent_user_playlist_content.id')
                ->delete();

        $this->info(
            'Deleted '.
            $emptyPlaylists.
            ' empty playlists '.
            Carbon::now()
                ->toDateTimeString()
        );

        $total = 0;

        $query =
            $dbConnection->table(config('railcontent.table_prefix').'user_playlists')
                ->where('migrated', '=',0);
        if (!empty($this->argument('brand')) && $this->argument('brand') != "all") {
            $query->where('brand', '=', $this->argument('brand'));
        }
        if (!empty($this->argument('startingUserId'))) {
            $query->where('user_id', '>', $this->argument('startingUserId'));
        }

        if (!empty($this->argument('endingUserId'))) {
            $query->where('user_id', '<', $this->argument('endingUserId'));
        }

        $parents = [];
        $migratedPlaylistIds = [];

        $playlists =
            $query->orderBy('id', 'asc')
                ->chunk(5000,
                    function (Collection $rows) use ($dbConnection, &$parents, &$total, &$migratedPlaylistIds) {
                        foreach ($rows as $row) {
                            $itemsOrdered = [];
                            $newItems = [];
                            $shouldBeRemoved = [];
                            $items =
                                $dbConnection->table(config('railcontent.table_prefix').'user_playlist_content')
                                    ->select(
                                        'railcontent_content.id',
                                        'railcontent_content.type',
                                        'railcontent_content.status',
                                        'railcontent_content.slug',
                                        'railcontent_user_playlist_content.*'
                                    )
                                    ->leftJoin(
                                        'railcontent_content',
                                        'railcontent_content.id',
                                        '=',
                                        config('railcontent.table_prefix').'user_playlist_content.content_id'
                                    )
                                    ->where('user_playlist_id', '=', $row->id)
                                    ->orderBy('railcontent_user_playlist_content.id', 'desc')
                                    ->get();

                            if ($items->isNotEmpty()) {
                                $position = 1;

                                $ids = [];
                                foreach ($items as $item) {
                                    if (in_array($item->type, [
                                        'course-part',
                                        'live',
                                        'challenges',
                                        'quick-tips',
                                        'play-along',
                                        'in-rhythm',
                                        'student-collaborations',
                                        'performances',
                                        'sonor-drums',
                                        'rhythms-from-another-planet',
                                        'exploring-beats',
                                        'pack-bundle-lesson',
                                        'study-the-greats',
                                        'student-focus',
                                        'gear-guides',
                                        'boot-camps',
                                        'learning-path-lesson',
                                        'semester-pack-lesson',
                                        'solos',
                                        'podcasts',
                                        'question-and-answer',
                                        'spotlight',
                                        'coach-stream',
                                        '25-days-of-christmas',
                                        'backstage-secrets',
                                        'diy-drum-experiments',
                                        'tama-drums',
                                        'rhythmic-adventures-of-captain-carson',
                                        'on-the-road',
                                        'camp-drumeo-ah',
                                        'namm-2019',
                                        'rudiment',
                                        'the-history-of-electronic-drums',
                                        'behind-the-scenes',
                                        'paiste-cymbals',
                                        'assignment',
                                        'recording',
                                        'chord-and-scale',
                                        'play-along-part',
                                        'student-review',
                                        'song-tutorial-children',
                                        'unit-part',
                                    ])) {
                                        $item->position = $position;
                                        $itemsOrdered[] = $item;
                                        $position++;
                                    } elseif ($item->type == 'song') {
                                        $item->position = $position;
                                        $item->extra_data = '{"is_full_track": true}';
                                        $itemsOrdered[] = $item;
                                        $position++;
                                    } elseif (($item->type == 'course') ||
                                        ($item->type == 'learning-path-course') ||
                                        ($item->type == 'semester-pack') ||
                                        ($item->type == 'pack-bundle') ||
                                        ($item->type == 'unit') ||
                                        ($item->type == 'song-tutorial')) {
                                        if (!isset($parents[$item->content_id])) {
                                            $parents[$item->content_id] = $dbConnection->table(
                                                config('railcontent.table_prefix').'content_hierarchy'
                                            )
                                                ->where('parent_id', '=', $item->content_id)
                                                ->get();
                                        }

                                        foreach ($parents[$item->content_id] as $lesson) {
                                            $newItems[] = [
                                                'content_id' => $lesson->child_id,
                                                'user_playlist_id' => $item->user_playlist_id,
                                                'position' => $position,
                                                'created_at' => $item->created_at,
                                                'extra_data' => null,
                                            ];
                                            $position++;
                                        }

                                        $shouldBeRemoved[] = $item->content_id;
                                    } elseif (($item->type == 'learning-path-level') ||
                                        ($item->type == 'pack') ||
                                        ($item->slug == 'singeo-method') ||
                                        ($item->slug == 'guitareo-method')) {
                                        if (!isset($parents[$item->content_id])) {
                                            $parents[$item->content_id] =
                                                $dbConnection->table('railcontent_content_hierarchy as ch_1')
                                                    ->select([
                                                                 'ch_2.child_id as child_id',
                                                             ])
                                                    ->join(
                                                        'railcontent_content_hierarchy as ch_2',
                                                        'ch_2.parent_id',
                                                        '=',
                                                        'ch_1.child_id'
                                                    )
                                                    ->where('ch_1.parent_id', $item->content_id)
                                                    ->orderBy('ch_2.child_position', 'asc')
                                                    ->get();
                                        }

                                        foreach ($parents[$item->content_id] as $lesson) {
                                            $newItems[] = [
                                                'content_id' => $lesson->child_id,
                                                'user_playlist_id' => $item->user_playlist_id,
                                                'position' => $position,
                                                'created_at' => $item->created_at,
                                                'extra_data' => null,
                                            ];
                                            $position++;
                                        }
                                        $shouldBeRemoved[] = $item->content_id;
                                    } elseif (($item->slug == 'drumeo-method') || ($item->slug == 'pianote-method')) {
                                        if (!isset($parents[$item->content_id])) {
                                            $parents[$item->content_id] =
                                                $dbConnection->table('railcontent_content_hierarchy as ch_1')
                                                    ->select([
                                                                 'ch_3.child_id as child_id',
                                                             ])
                                                    ->join(
                                                        'railcontent_content_hierarchy as ch_2',
                                                        'ch_2.parent_id',
                                                        '=',
                                                        'ch_1.child_id'
                                                    )
                                                    ->join(
                                                        'railcontent_content_hierarchy as ch_3',
                                                        'ch_3.parent_id',
                                                        '=',
                                                        'ch_2.child_id'
                                                    )
                                                    ->where('ch_1.parent_id', $item->content_id)
                                                    ->orderBy('ch_3.child_position', 'asc')
                                                    ->get();
                                        }
                                        foreach ($parents[$item->content_id] as $lesson) {
                                            $newItems[] = [
                                                'content_id' => $lesson->child_id,
                                                'user_playlist_id' => $item->user_playlist_id,
                                                'position' => $position,
                                                'created_at' => $item->created_at,
                                                'extra_data' => null,
                                            ];
                                            $position++;
                                        }
                                        $shouldBeRemoved[] = $item->content_id;
                                    } elseif (($item->content_id == 0) || ($item->type == null)) {
                                        $shouldBeRemoved[] = $item->content_id;
                                    } else {
                                        $this->error('NOT MIGRATEDDDDDDD '.$item->id);
                                        $this->info($item->type);
                                    }
                                }

                                if (!empty($itemsOrdered)) {
                                    $statement =
                                        "INSERT into railcontent_user_playlist_content (id, position, content_id, user_playlist_id, created_at) VALUES ";
                                    foreach ($itemsOrdered as $itemOrder) {
                                        if ($itemOrder->position != 0) {
                                            $statement .= "(".
                                                $itemOrder->id.
                                                ','.
                                                $itemOrder->position.
                                                ','.
                                                $itemOrder->content_id.
                                                ','.
                                                $itemOrder->user_playlist_id.
                                                ',"'.
                                                $itemOrder->created_at.
                                                '"),';
                                            $ids[] = $itemOrder->content_id;
                                        }
                                    }
                                    $statement = rtrim($statement, ',');
                                    $statement .= ' ON DUPLICATE KEY UPDATE position = VALUES(position); ';

                                    $dbConnection->statement($statement);
                                }

                                if (!empty($newItems)) {
                                    $statement =
                                        "INSERT into railcontent_user_playlist_content (position, content_id, user_playlist_id, created_at) VALUES ";
                                    foreach ($newItems as $item) {
                                        if ($item['position'] != 0) {
                                            $statement .= "(".
                                                $item['position'].
                                                ','.
                                                $item['content_id'].
                                                ','.
                                                $item['user_playlist_id'].
                                                ',"'.
                                                $item['created_at'].
                                                '"),';
                                            $ids[] = $item['content_id'];
                                        }
                                    }
                                    $statement = rtrim($statement, ',');

                                    $dbConnection->statement($statement);
                                }

                                if (!empty($shouldBeRemoved)) {
                                    $dbConnection->table(config('railcontent.table_prefix').'user_playlist_content')
                                        ->whereIn('content_id', $shouldBeRemoved)
                                        ->delete();
                                }

                                //                        $duration =
                                //                            $dbConnection->table('railcontent_content_fields')
                                //                                ->selectRaw(
                                //                                    'sum(length_in_seconds) as duration',
                                //                                )
                                //                                ->join(
                                //                                    'railcontent_content',
                                //                                    'railcontent_content_fields.value',
                                //                                    '=',
                                //                                    'railcontent_content.id'
                                //                                )
                                //                                ->whereIn('content_id', $ids)
                                //                                ->where('railcontent_content_fields.key', '=', 'video')
                                //                                ->orderBy('railcontent_content_fields.id', 'asc')
                                //                                ->first();

                                //                        $sql = <<<'EOT'
                                //        UPDATE `%s` cs
                                //        SET cs.`type` = '%s', cs.name = '%s', cs.migrated = '%s', cs.duration = '%s'
                                //        where cs.id = '%s'
                                //
                                //        EOT;
                                //
                                //                        $statement = sprintf(
                                //                            $sql,
                                //                            config('railcontent.table_prefix').'user_playlists',
                                //                            'user-playlist',
                                //                            'My List',
                                //                            true,
                                //                            $duration->duration,
                                //                            $row->id
                                //                        );
                                //                        $dbConnection->statement($statement);
                                $migratedPlaylistIds[] = $row->id;
                            } else {
                                //                        $dbConnection->table('railcontent_user_playlists')
                                //                            ->where('id', '=', $row->id)
                                //                            ->delete();
                            }
                        }

                                    $total = $total + count($rows);
                                    $this->info(
                                        'Migrated '.
                                        $total.
                                        ' items  '.
                                        Carbon::now()
                                            ->toDateTimeString()
                                    );
                    });

        $dbConnection->table('railcontent_user_playlists')
            ->leftJoin(
                'railcontent_user_playlist_content',
                'railcontent_user_playlists.id',
                '=',
                'railcontent_user_playlist_content.user_playlist_id'
            )
            ->whereNull('railcontent_user_playlist_content.id')
            ->delete();

        if(!empty($migratedPlaylistIds)) {
            $sql = <<<'EOT'
        UPDATE `%s` cs
        SET cs.`type` = '%s', cs.name = '%s', cs.migrated = %s
        where cs.id IN (%s)

        EOT;

            $statement = sprintf(
                $sql,
                config('railcontent.table_prefix').'user_playlists',
                'user-playlist',
                'My List',
                1,
                implode(
                    ", ",
                    $migratedPlaylistIds
                )
            );
            $dbConnection->statement($statement);
        }

        $finish = microtime(true) - $start;
        $format = "Finished user playlist data migration(%s) in total %s seconds\n ";
        $this->info(sprintf($format, $total, $finish));
    }
}
