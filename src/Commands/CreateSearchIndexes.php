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
    protected $signature = 'command:createSearchIndexes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create search indexes';

    protected $searchRepository;

    protected $contentRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FullTextSearchRepository $searchRepository, ContentRepository $contentRepository)
    {
        parent::__construct();

        $this->searchRepository = $searchRepository;

        $this->contentRepository = $contentRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ContentRepository::$availableContentStatues = ConfigService::$indexableContentStatuses;
        ContentRepository::$pullFutureContent = false;

        $this->searchRepository->createSearchIndexes();
    }


}
