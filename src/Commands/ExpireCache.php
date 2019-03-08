<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use Illuminate\Console\Command;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Repositories\ContentRepository;

class ExpireCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:expireCache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check contents published_on date and delete cache if publish date has passed';

    /**
     * @var ContentRepository
     */
    protected $contentRepository;

    /**
     * @var EntityManager
     */
    protected $entityManager;

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
    }

    /**
     * Execute the console command. In the command we set/get a cache key(expireCacheCommand) in the Redis that contain
     * the last execution time of the command and we check in the database if exists contents rows where the
     * published_on date has been passed from the last execution time. If exists rows we clear the contents caches.
     *
     * @return boolean
     */
    public function handle()
    {
        $lastExecutionTime =
            Carbon::now()
                ->subHour()
                ->toDateTimeString();

        $this->entityManager->getConfiguration()
            ->getMetadataCacheImpl()
            ->save('expireCacheCommand', $lastExecutionTime, 0);

        $alias = 'content';
        $qb = $this->contentRepository->createQueryBuilder($alias);

        $qb->where($alias . '.user is null')
            ->andWhere($alias . '.publishedOn >= :publishedOn')
            ->andWhere($alias . '.publishedOn <= :now')
            ->setParameter(
                'now',
                Carbon::now()
                    ->toDateTimeString()
            )
            ->setParameter('publishedOn', $lastExecutionTime);

        $contents =
            $qb->getQuery()
                ->getResult();

        if (!empty($contents)) {
            foreach ($contents as $content) {
                $this->entityManager->getCache()
                    ->evictEntity(Content::class, $content->getId());
            }
        }

        //update last execution time to current time
        $this->entityManager->getConfiguration()
            ->getMetadataCacheImpl()
            ->delete('expireCacheCommand');

        $this->entityManager->getConfiguration()
            ->getMetadataCacheImpl()
            ->save(
                'expireCacheCommand',
                Carbon::now()
                    ->toDateTimeString(),
                0
            );

        return true;
    }
}