<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Services\ConfigService;

class AddExternalVideoId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AddExternalVideoId';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AddExternalVideoId';

    /**
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        parent::__construct();

        $this->databaseManager = $databaseManager;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $start = microtime(true);

        $this->info("Started adding");

        $chunkSize = 1000;

        $this->databaseManager->connection(config('railcontent.database_connection_name'))
            ->table(ConfigService::$tableContent)
            ->select(ConfigService::$tableContent.'.id',ConfigService::$tableContent.'.type', 'video.vimeo_video_id', 'video.youtube_video_id')
            ->join(ConfigService::$tableContent.' as video', ConfigService::$tableContent.'.video','=','video.id')
            ->whereNotNull(ConfigService::$tableContent.'.video')
            ->orderBy(ConfigService::$tableContent.'.id', 'desc')
            ->chunk(
                $chunkSize,
                function (Collection $rows) {

                    foreach ($rows as $item) {
                        $externalVideoId= $item->youtube_video_id ?? $item->vimeo_video_id;
                        $this->databaseManager->connection(config('railcontent.database_connection_name'))
                        ->table(ConfigService::$tableContent)
                            ->where('id',$item->id)
                            ->update([
                                         'external_video_id' => $externalVideoId
                                     ]);
                        $this->info('Updated lesson with id:'.$item->id. '    with external id:'.$externalVideoId);

                    }
                }
            );

        $finish = microtime(true) - $start;

        $format = "Finished in total %s seconds\n";

        $this->info(sprintf($format, $finish));
    }
}
