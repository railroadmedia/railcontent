<?php

namespace App\Modules\Content\Console\Commands;

use App\Modules\Content\Models\UserPlaylist;
use App\Modules\Content\Models\UserPlaylistContent;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

class MigrateMissingPlaylistsItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MigrateMissingPlaylistsItems {startIndex=0} {endIndex=-1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate missing playlists items';

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
    public function handle(): void
    {
        $dbConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();
        $pdo = $dbConnection->getPdo();
        $pdo->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');

        $startIndex = $this->argument('startIndex');
        $endIndex = $this->argument('endIndex');
        $parents = [];
        $added = 0;

        [$csv, $headersRow] = $this->getCSV($startIndex, $endIndex);

        $this->withProgressBar($csv, function ($row) use ($dbConnection, $headersRow, &$parents, &$added) {
            $data = $this->getData($row, $headersRow);
            $userId = $this->getValue($data, $headersRow, 'user_id');
            $brand = $this->getValue($data, $headersRow, 'brand');
            $contentId = $this->getValue($data, $headersRow, 'content_id');
            $contentType = $this->getValue($data, $headersRow, 'type');

            $playlist =
                UserPlaylist::query()
                    ->where('user_id', $userId)
                    ->where('category', '=', 'My List')
                    ->where('name', 'LIKE', '%My List%')
                    ->where('brand', '=', $brand)
                    ->orderBy('id', 'desc')
                    ->first();
            if (!$playlist) {
                $this->info('Not exists playlist for userId ==='.$userId.'     '.$brand);

                return;
            }

            if (in_array($contentType, [
                'course',
                'learning-path-course',
                'semester-pack',
                'pack-bundle',
                'unit',
                'song-tutorial',
            ])) {
                if (!isset($parents[$contentId])) {
                    $parents[$contentId] = $dbConnection->table(
                        config('railcontent.table_prefix').'content_hierarchy'
                    )
                        ->where('parent_id', '=', $contentId)
                        ->get();
                }

                foreach ($parents[$contentId] as $lesson) {
                    $playlist = $this->addLessonToPlaylist(
                        $lesson->child_id,
                        $brand,
                        $userId,
                        $playlist,
                        $added
                    );
                }
            } elseif (in_array($contentType, [
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
                $playlist = $this->addLessonToPlaylist(
                    $contentId,
                    $brand,
                    $userId,
                    $playlist,
                    $added
                );
            }

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
                    ->whereIn('railcontent_user_playlist_content.user_playlist_id', [$playlist->id])
                    ->where('railcontent_content_fields.key', '=', 'video')
                    ->orderBy('railcontent_content_fields.id', 'asc')
                    ->first();

            $playlist->duration = $duration->duration ?? 0;
            $playlist->save();
        });

        $this->info('Finished user playlist data migration');
    }

    public function getCSV(int $startIndex, int $endIndex): array
    {
        $fileName = 'missing-items.csv';
        $filePath = app_path().'/Modules/Content/Console/Commands/Data/'.$fileName;
        $file = file($filePath);
        $csv = array_map('str_getcsv', $file);
        $headersRow = $csv[0];
        unset($csv[0]);
        if ($endIndex == -1 or $endIndex > count($csv)) {
            $endIndex = count($csv);
        }
        $csv = array_slice($csv, $startIndex, $endIndex - $startIndex);

        return [$csv, $headersRow];
    }

    private function getData($row, $headersRow): array
    {
        $data = [];
        for ($i = 0; $i < count($row); $i++) {
            $data[$headersRow[$i]] = $row[$i];
        }

        return $data;
    }

    private function getValue(array $data, mixed $headersRow, string $name): ?string
    {
        if (!in_array($name, $headersRow)) {
            throw new \Exception("Header '$name' does not exist in array");
        }

        return $data[$name] ?? "";
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection|array $playlistItems
     * @param mixed $lesson
     * @param int $playlistItemsCount
     * @param string|null $brand
     * @param string|null $userId
     * @param \Illuminate\Database\Eloquent\Model|object|\Illuminate\Database\Eloquent\Builder|UserPlaylist $playlist
     * @param int $added
     * @return int
     */
    private function addLessonToPlaylist(
        $lessonId,
        ?string $brand,
        ?string $userId,
        $playlist
    ): int {
        $playlistItems =
            UserPlaylistContent::query()
                ->where('user_playlist_id', $playlist->id)
                ->get();
        $playlistItemsCount = count($playlistItems);

        $exist =
            $playlistItems->where('content_id', '=', $lessonId)
                ->count();
        if ($exist == 0) {
            if (($playlistItemsCount + 1) >= (config('railcontent.playlist_items_limit', 300))) {
                $newPlaylist = new UserPlaylist();
                $newPlaylist->brand = $brand;
                $newPlaylist->type = 'user-playlist';
                $newPlaylist->user_id = $userId;
                $newPlaylist->created_at = $playlist->created_at;
                $newPlaylist->name = 'My List - 2';
                $newPlaylist->description = '';
                $newPlaylist->category = 'My List';
                $newPlaylist->private = 1;
                $newPlaylist->save();
                $playlist = $newPlaylist;
                $playlistItemsCount = 1;
                $playlistItem = new UserPlaylistContent();
                $playlistItem->user_playlist_id = $playlist->id;
                $playlistItem->content_id = $lessonId;
                $playlistItem->position = $playlistItemsCount;
                $playlistItem->save();
            } else {
                $playlistItemsCount++;
                $playlistItem = new UserPlaylistContent();
                $playlistItem->user_playlist_id = $playlist->id;
                $playlistItem->content_id = $lessonId;
                $playlistItem->position = $playlistItemsCount;
                $playlistItem->save();
            }
        }

        return $playlist;
    }
}
