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

        $this->clearPlaylistItems($dbConnection);

        $total = 0;

        $query =
            $dbConnection->table(config('railcontent.table_prefix').'user_playlists')
                ->where('migrated', '=', false)
                ->where('type', '=', 'primary-playlist');
        if (!empty($this->argument('brand')) && $this->argument('brand') != "all") {
            $query->where('brand', '=', $this->argument('brand'));
        }
        if (!empty($this->argument('startingUserId'))) {
            $query->where('user_id', '>=', $this->argument('startingUserId'));
        }

        if (!empty($this->argument('endingUserId'))) {
            $query->where('user_id', '<=', $this->argument('endingUserId'));
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
                            $index = 1;
                            $migratedItems = 0;
                            $playlistId = null;

                            $playlistsIds = [$row->id];
                            $items =
                                $dbConnection->table(config('railcontent.table_prefix').'user_playlist_content')
                                    ->select(
                                        'railcontent_content.id',
                                        'railcontent_content.type',
                                        'railcontent_content.status',
                                        'railcontent_content.slug',
                                        'railcontent_user_playlist_content.*'
                                    )
                                    ->join(
                                        'railcontent_content',
                                        'railcontent_content.id',
                                        '=',
                                        config('railcontent.table_prefix').'user_playlist_content.content_id'
                                    )
                                    ->where('user_playlist_id', '=', $row->id)
                                    ->orderBy('railcontent_user_playlist_content.id', 'asc')
                                    ->get();

                            if ($items->isNotEmpty()) {
                                $position = 1;
                                $ids = [];
//                                $firstMigratedItemId = false;
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
                                        if (($migratedItems + 1) >=
                                            (config('railcontent.playlist_items_limit', 300))) {
                                            $position = 1;
                                            $migratedItems = 0;
                                            $insertData = [
                                                'brand' => $row->brand,
                                                'type' => 'user-playlist',
                                                'user_id' => $row->user_id,
                                                'name' => 'My list - '.$index,
                                                'created_at' => $row->created_at,
                                                'migrated' => 1,
                                            ];
                                            $item->user_playlist_id =
                                            $playlistId =
                                                $dbConnection->table('railcontent_user_playlists')
                                                    ->insertGetId($insertData);

                                            $index++;
                                            $playlistsIds[] = $playlistId;
//                                            $firstMigratedItemId = ($index == 1) ? $item->id : $firstMigratedItemId;
                                        }
                                        $item->position = $position;
                                        $item->user_playlist_id = (isset($playlistId))? $playlistId : $item->user_playlist_id;

                                        $item->extra_data = '{}';
                                        $itemsOrdered[] = $item;
                                        $position++;
                                        $migratedItems++;
                                    } elseif ($item->type == 'song') {
                                        if (($migratedItems + 1) >=
                                            (config('railcontent.playlist_items_limit', 300))) {
                                            $position = 1;
                                            $migratedItems = 0;
                                            $insertData = [
                                                'brand' => $row->brand,
                                                'type' => 'user-playlist',
                                                'user_id' => $row->user_id,
                                                'name' => 'My list - '.$index,
                                                'created_at' => $row->created_at,
                                                'migrated' => 1,
                                            ];
                                            $playlistId =
                                                $dbConnection->table('railcontent_user_playlists')
                                                    ->insertGetId($insertData);
//                                            $firstMigratedItemId = ($index == 1) ? $item->id : $firstMigratedItemId;
                                            $index++;
                                            $playlistsIds[] = $playlistId;
                                        }
                                        $item->position = $position;
                                        $item->user_playlist_id = (isset($playlistId))? $playlistId : $item->user_playlist_id;
                                        $item->extra_data = json_encode(['is_full_track' => true]);
                                        $itemsOrdered[] = $item;
                                        $position++;
                                        $migratedItems++;
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
                                            if (($migratedItems + 1) >=
                                                (config('railcontent.playlist_items_limit', 300))) {
                                                $position = 1;
                                                $migratedItems = 0;
                                                $insertData = [
                                                    'brand' => $row->brand,
                                                    'type' => 'user-playlist',
                                                    'user_id' => $row->user_id,
                                                    'name' => 'My list - '.$index,
                                                    'created_at' => $row->created_at,
                                                    'migrated' => 1,
                                                ];
                                                $playlistId =
                                                    $dbConnection->table('railcontent_user_playlists')
                                                        ->insertGetId($insertData);
//                                                $firstMigratedItemId = ($index == 1) ? $item->id : $firstMigratedItemId;
                                                $index++;
                                                $playlistsIds[] = $playlistId;
                                                       }
                                            $item->user_playlist_id = (isset($playlistId))? $playlistId : $item->user_playlist_id;
                                            $newItems[] = [
                                                'content_id' => $lesson->child_id,
                                                'user_playlist_id' => $item->user_playlist_id,
                                                'position' => $position,
                                                'created_at' => $item->created_at,
                                                'extra_data' => null,
                                            ];
                                            $position++;
                                            $migratedItems++;
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
                                            if (($migratedItems + 1) >=
                                                (config('railcontent.playlist_items_limit', 300))) {
                                                $position = 1;
                                                $migratedItems = 0;
                                                $insertData = [
                                                    'brand' => $row->brand,
                                                    'type' => 'user-playlist',
                                                    'user_id' => $row->user_id,
                                                    'name' => 'My list - '.$index,
                                                    'created_at' => $row->created_at,
                                                    'migrated' => 1,
                                                ];
                                                $playlistId =
                                                    $dbConnection->table('railcontent_user_playlists')
                                                        ->insertGetId($insertData);
//                                                $firstMigratedItemId = ($index == 1) ? $item->id : $firstMigratedItemId;
                                                $index++;
                                                $playlistsIds[] = $playlistId;
                                            }
                                            $item->user_playlist_id = (isset($playlistId))? $playlistId : $item->user_playlist_id;
                                            $newItems[] = [
                                                'content_id' => $lesson->child_id,
                                                'user_playlist_id' => $item->user_playlist_id,
                                                'position' => $position,
                                                'created_at' => $item->created_at,
                                                'extra_data' => null,
                                            ];

                                            $position++;
                                            $migratedItems++;
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
                                            if (($migratedItems + 1) >=
                                                (config('railcontent.playlist_items_limit', 300))) {
                                                $position = 1;
                                                $migratedItems = 0;
                                                $insertData = [
                                                    'brand' => $row->brand,
                                                    'type' => 'user-playlist',
                                                    'user_id' => $row->user_id,
                                                    'name' => 'My list - '.$index,
                                                    'created_at' => $row->created_at,
                                                    'migrated' => 1,
                                                ];
                                                $playlistId =
                                                    $dbConnection->table('railcontent_user_playlists')
                                                        ->insertGetId($insertData);
//                                                $firstMigratedItemId = ($index == 1) ? $item->id : $firstMigratedItemId;
                                                $index++;
                                                $playlistsIds[] = $playlistId;
                                            }
                                            $item->user_playlist_id = (isset($playlistId))? $playlistId : $item->user_playlist_id;
                                            $newItems[] = [
                                                'content_id' => $lesson->child_id,
                                                'user_playlist_id' => $item->user_playlist_id,
                                                'position' => $position,
                                                'created_at' => $item->created_at,
                                                'extra_data' => null,
                                            ];

                                            $position++;
                                            $migratedItems++;
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
                                        "INSERT into railcontent_user_playlist_content (id, position, content_id, user_playlist_id, extra_data, created_at) VALUES ";
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
                                                ',\''.
                                                ($itemOrder->extra_data).
                                                '\',"'.
                                                $itemOrder->created_at.
                                                '"),';
                                            $ids[] = $itemOrder->content_id;
                                        } 
                                    }
                                    $statement = rtrim($statement, ',');
                                    $statement .= " ON DUPLICATE KEY UPDATE position = VALUES(position), extra_data = VALUES(extra_data), user_playlist_id = VALUES(user_playlist_id); ";

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

                                foreach ($playlistsIds as $key => $migrated) {
                                    $duration =
                                        $dbConnection->table('railcontent_content_fields')
                                            ->selectRaw(
                                                'sum(length_in_seconds) as duration'
                                            )
                                            ->join(
                                                'railcontent_content',
                                                'railcontent_content_fields.value',
                                                '=',
                                                'railcontent_content.id'
                                            )
                                            ->join(
                                                'railcontent_user_playlist_content',
                                                'railcontent_content_fields.content_id',
                                                '=',
                                                'railcontent_user_playlist_content.content_id'
                                            )
                                            ->whereIn('railcontent_user_playlist_content.user_playlist_id', [$migrated])
                                            ->where('railcontent_content_fields.key', '=', 'video')
                                            ->orderBy('railcontent_content_fields.id', 'asc')
                                            ->first();
                                    $sql = <<<'EOT'
        UPDATE `%s` cs
        SET  cs.duration = %s,  cs.name = '%s'
        where cs.id = (%s)
        EOT;

                                    $statement = sprintf(
                                        $sql,
                                        config('railcontent.table_prefix').'user_playlists',
                                        $duration->duration ?? 0,
                                        'My List - '.($key + 1),
                                        $migrated
                                    );
                                    $dbConnection->statement($statement);
                                }
                                $migratedPlaylistIds[] = $row->id;
                            }
//                            if (isset($firstMigratedItemId) && ($firstMigratedItemId > 1)) {
//                                $dbConnection->table(config('railcontent.table_prefix').'user_playlist_content')
//                                    ->where('id', '>=', $firstMigratedItemId)
//                                    ->where('user_playlist_id', '=', $row->id)
//                                    ->delete();
//                            }
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

        if(!empty($migratedPlaylistIds)) {
            $sql = <<<'EOT'
        UPDATE `%s` cs
        SET cs.`type` = '%s', cs.migrated = %s, cs.category = '%s'
        where cs.id IN (%s)
        EOT;

            $statement = sprintf(
                $sql,
                config('railcontent.table_prefix').'user_playlists',
                'user-playlist',
                1,
                'My List',
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

    private function clearPlaylistItems($dbConnection)
    {
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

        $this->info(
            'Deleted '.
            $del.
            ' items that do not have the published status '.
            Carbon::now()
                ->toDateTimeString()
        );

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
            $instructors.
            ' instructors items '.
            Carbon::now()
                ->toDateTimeString()
        );

        // delete empty playlists
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

        //delete items with content_id = 0 from playlist
        $wrongContent =
            $dbConnection->table(config('railcontent.table_prefix').'user_playlist_content')
                ->where('railcontent_user_playlist_content.content_id', '=', 0)
                ->delete();

        $this->info(
            'Deleted '.
            $wrongContent.
            ' items with content_id = 0 '.
            Carbon::now()
                ->toDateTimeString()
        );

        return true;
    }
}
