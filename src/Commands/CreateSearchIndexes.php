<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\FullTextSearchRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;

class CreateSearchIndexes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:createSearchIndexesForContents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create search indexes';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(FullTextSearchRepository $searchRepository, ContentRepository $contentRepository)
    {
        ContentRepository::$availableContentStatues = ConfigService::$indexableContentStatuses;
        ContentRepository::$pullFutureContent = false;

        $searchRepository->createSearchIndexes();
    }
}
