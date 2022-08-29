<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Repositories\RepositoryBase;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class FillContentCompiledViewData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FillContentCompiledViewData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'FillContentCompiledViewData';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager, ContentService $contentService)
    {
        $this->info('Starting FillContentCompiledViewData...');

        $dbConnection = RepositoryBase::$connectionMask;
        $dbConnection->disableQueryLog();

        $totalProcessed = 0;

        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->orderBy(config('railcontent.table_prefix') . 'content.id', 'desc')
            // for testing only
//            ->where('id', 360406)
//                ->whereNotIn('type', ['youtube-video', 'vimeo-video', 'assignment'])
            ->chunk(250, function (Collection $rows) use ($contentService, $dbConnection, &$totalProcessed) {
                $contentService->fillCompiledViewContentDataColumnForContentIds($rows->pluck('id')->toArray());
                $totalProcessed += $rows->count();

                $this->info('Done ' . $totalProcessed);
            });


        $this->info('Finished FillContentCompiledViewData...');

        return true;
    }
}
