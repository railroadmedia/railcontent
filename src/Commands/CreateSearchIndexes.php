<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use Illuminate\Console\Command;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\SearchIndex;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\ContentRepository;

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
     * @var ObjectRepository|EntityRepository
     */
    protected $searchRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    protected $contentRepository;

    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RailcontentEntityManager $entityManager)
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

        ContentRepository::$availableContentStatues = config('railcontent.indexable_content_statuses');
        ContentRepository::$pullFutureContent = false;

        $this->searchRepository->deleteOldIndexes();

        $contents =
            $this->contentRepository->build()
                ->restrictByTypes(config('railcontent.searchable_content_types'))
                ->restrictBrand()
                ->orderByColumn(config('railcontent.table_prefix') . 'content','id','asc')
                ->getQuery()
                ->getResult();

        foreach ($contents as $content) {

            $searchIndex = new SearchIndex();
            $searchIndex->setBrand($content->getBrand());
            $searchIndex->setContentType($content->getType());
            $searchIndex->setContentStatus($content->getStatus());
            $searchIndex->setContentPublishedOn($content->getPublishedOn() ?? Carbon::now());
            $searchIndex->setHighValue($this->searchRepository->prepareIndexesValues('high_value', $content));
            $searchIndex->setMediumValue($this->searchRepository->prepareIndexesValues('medium_value', $content));
            $searchIndex->setLowValue($this->searchRepository->prepareIndexesValues('low_value', $content));
            $searchIndex->setContent($content);

            $this->entityManager->persist($searchIndex);
        }

        $this->entityManager->flush();

        $this->info('CreateSearchIndexesForContents complete.');
    }
}