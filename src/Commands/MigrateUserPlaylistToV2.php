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
    protected $signature = 'MigrateUserPlaylistToV2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate user playlists to the new v2 structure';

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * MigrateUserPlaylist constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param UserProviderInterface $userProvider
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
        //TODO :    UPDATE PLAYLIST ITEMS
        // SHOULD NOT BE INCLUDED IN CODE REVIEW
        $dbConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();
        $pdo = $dbConnection->getPdo();
        $pdo->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');

        $start = microtime(true);

        $this->info(
            'Migrate user playlists command starting :::: '.
            Carbon::now()
                ->toDateTimeString()
        );

        $dbConnection->table(config('railcontent.table_prefix').'user_playlists')
            //            ->select(
            //                'railcontent_content.id',
            //                'railcontent_content.type',
            //                'railcontent_user_playlist_content.*'
            //            )
            //            ->leftJoin('railcontent_content', 'railcontent_content.id', '=', config('railcontent.table_prefix') . 'user_playlist_content.content_id')
            //            ->whereNot('railcontent_content.type', 'user-playlist')
            //            ->whereIn('key', $contentColumnNames)
            ->where('type', '=', 'primary-playlist')
            ->where('id', '=', 4)
            ->orderBy('id', 'asc')
            ->chunk(5, function (Collection $rows) use ($dbConnection) {
                foreach ($rows as $row) {
                    $items =
                        $dbConnection->table(config('railcontent.table_prefix').'user_playlist_content')
                            ->select(
                                'railcontent_content.id',
                                'railcontent_content.type',
                                'railcontent_user_playlist_content.*'
                            )
                            ->leftJoin(
                                'railcontent_content',
                                'railcontent_content.id',
                                '=',
                                config('railcontent.table_prefix').'user_playlist_content.content_id'
                            )
                            //            ->whereNot('railcontent_content.type', 'user-playlist')
                            //            ->whereIn('key', $contentColumnNames)
                            // ->where('position', '=', 0)
                            ->where('user_playlist_id', '=', $row->id)
                            ->orderBy('created_at', 'desc')
                            //            ->whereNotIn('value', ['Invalid date'])
                            ->get();
                    if ($items->isNotEmpty()) {
                        $itemsOrdered = [];
                        $position = 1;
                        $newItems = [];
                        $shouldBeRemoved = [];
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
                                                    ])) {
                                $item->position = $position;
                                $itemsOrdered[] = $item;
                                $position++;
                                //
                            } elseif (($item->type == 'course') || ($item->type == 'song')) {
                                $lessons =
                                    $dbConnection->table(config('railcontent.table_prefix').'content_hierarchy')
                                        ->where('parent_id', '=', $item->content_id)
                                        ->get();

                                foreach ($lessons as $lesson) {
                                    $newItems[] = [
                                        'content_id' => $lesson->child_id,
                                        'user_playlist_id' => $item->user_playlist_id,
                                        'position' => $position,
                                        'created_at' => $item->created_at,
                                        'extra_data' =>($item->type == 'song')?'{"is_full_track": true}':null
                                    ];
                                    // $itemsOrdered[] = $item;
                                    $position++;
                                }
                                $shouldBeRemoved[] = $item->content_id;
                            } elseif (($item->type != 'song') && ($item->type != 'course')) {
                                dd($item);
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
                                }
                            }
                            $statement = rtrim($statement, ',');
                            $statement .= ' ON DUPLICATE KEY UPDATE position = VALUES(position); ';

                            $dbConnection->statement($statement);
                            // dd($statement);
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
                                }
                            }
                            $statement = rtrim($statement, ',');
                            // $statement .= ' ON DUPLICATE KEY UPDATE position = VALUES(position); ';

                            $dbConnection->statement($statement);
                        }

                        if (!empty($shouldBeRemoved)) {
                            $dbConnection->table(config('railcontent.table_prefix').'user_playlist_content')->whereIn('content_id', $shouldBeRemoved)
                                ->delete();
                        }
                    }

                    //        ->chunk(5, function (Collection $rows) {
                    //            foreach ($rows as $row) {
                    //                if (in_array($row['type'], ['course-part', 'live'])) {
                    //                }
                    //            }
                    //        });
                }
            });

        //        $dbConnection->table(config('railcontent.table_prefix') . 'user_playlist_content')
        //            ->select(
        //                'railcontent_content.id',
        //                'railcontent_content.type',
        //                'railcontent_user_playlist_content.*'
        //            )
        //            ->leftJoin('railcontent_content', 'railcontent_content.id', '=', config('railcontent.table_prefix') . 'user_playlist_content.content_id')
        ////            ->whereNot('railcontent_content.type', 'user-playlist')
        ////            ->whereIn('key', $contentColumnNames)
        //            ->where('position','=',0)
        ////            ->whereNotIn('value', ['Invalid date'])
        //            ->orderBy('user_playlist_id', 'asc')
        //            ->chunk(5, function (Collection $rows)  {
        //foreach($rows as $row){
        //    if(in_array($row['type'], ['course-part','live'])){
        //
        //    }
        //}
        //            });
        //
        //        $sql = <<<'EOT'
        //UPDATE `%s` cs
        //SET cs.`type` = '%s', cs.name = '%s', cs.thumbnail_url = '%s'
        //
        //EOT;
        //
        //        $statement = sprintf(
        //            $sql,
        //            config('railcontent.table_prefix').'user_playlists',
        //            'user-playlist',
        //            'My List',
        //            'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/00a9cf48-0bad-4b94-6d6a-d4aa73a63f00/public'
        //        );
        //        $dbConnection->statement($statement);
        //
        //        $finish = microtime(true) - $start;
        //        $format = "Finished user playlist data migration  in total %s seconds\n ";
        //        $this->info(sprintf($format, $finish));
    }
}
