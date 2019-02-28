<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use Illuminate\Console\Command;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\SearchIndex;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;


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

    private $entityManager;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
        $this->contentRepository = $this->entityManager->getRepository(Content::class);
        $this->searchRepository = $this->entityManager->getRepository(SearchIndex::class);
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

        $contents = $this->contentRepository->build()
            ->restrictByTypes(ConfigService::$searchableContentTypes)
            ->restrictBrand()
            ->orderBy(ConfigService::$tableContent . '.id')
            ->getQuery()
            ->getResult();

        foreach ($contents as $content) {

            $searchInsertData = [
                'content_id' => $content->getId(),
                'high_value' => $this->searchRepository->prepareIndexesValues('high_value', $content),
                'medium_value' => $this->searchRepository->prepareIndexesValues('medium_value', $content),
                'low_value' => $this->searchRepository->prepareIndexesValues('low_value', $content),
                'brand' => $content->getBrand(),
                'content_type' => $content->getType(),
                'content_status' => $content->getStatus(),
                'content_published_on' => $content->getPublishedOn() ?? Carbon::now(),
                'created_at' => Carbon::now()
                    ->toDateTimeString(),
            ];

            $searchIndex = new SearchIndex();
            $searchIndex->setBrand($searchInsertData['brand']);
            $searchIndex->setContentType($searchInsertData['content_type']);
            $searchIndex->setContentStatus($searchInsertData['content_status']);
            $searchIndex->setContentPublishedOn($searchInsertData['content_published_on']);
            $searchIndex->setHighValue($searchInsertData['high_value']);
            $searchIndex->setMediumValue($searchInsertData['medium_value']);
            $searchIndex->setLowValue($searchInsertData['low_value']);
            $searchIndex->setContent($content);

            $this->entityManager->persist($searchIndex);
        }

        $this->entityManager->flush();

        $this->info('CreateSearchIndexesForContents complete.');
    }
}