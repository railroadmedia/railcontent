<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
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
        $this->info('CreateSearchIndexesForContents starting.');

        ContentRepository::$availableContentStatues = ConfigService::$indexableContentStatuses;
        ContentRepository::$pullFutureContent = false;

        $this->searchRepository->deleteOldIndexes();

        $contents =
            $this->contentRepository->query()
                ->selectPrimaryColumns()
                ->restrictByTypes(ConfigService::$searchableContentTypes)
                ->restrictBrand()
                ->orderBy('id')
                ->get();

        foreach ($contents as $content) {
            $searchInsertData = [
                'content_id' => $content['id'],
                'high_value' => $this->searchRepository->query()
                    ->prepareIndexesValues('high_value', $content),
                'medium_value' => $this->searchRepository->query()
                    ->prepareIndexesValues('medium_value', $content),
                'low_value' => $this->searchRepository->query()
                    ->prepareIndexesValues('low_value', $content),
                'brand' => $content['brand'],
                'content_type' => $content['type'],
                'content_status' => $content['status'],
                'content_published_on' => $content['published_on'] ?? Carbon::now(),
                'created_at' => Carbon::now()
                    ->toDateTimeString(),
            ];

            $this->searchRepository->query()
                ->insert($searchInsertData);
        }
        $this->info('CreateSearchIndexesForContents complete.');
    }
}