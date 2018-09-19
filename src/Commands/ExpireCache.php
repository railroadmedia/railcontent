<?php

namespace Railroad\Railcontent\Commands;


use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ContentRepository $contentRepository)
    {
        parent::__construct();

        $this->contentRepository = $contentRepository;
    }

    /**
     * Execute the console command. In the command we set/get a cache key(expireCacheCommand) in the Redis that contain the last execution time of the command and
     * we check in the database if exists contents rows where the published_on date has been passed from the last execution time. If exists rows we clear the contents caches.
     *
     * @return boolean
     */
    public function handle()
    {
        $lastExecutionTime = Cache::store(ConfigService::$cacheDriver)->rememberForever(
            'expireCacheCommand',
            function ()  {
                return Carbon::now()->subHour()->toDateTimeString();
            });

        $contents = $this->contentRepository->getRecentPublishedContents($lastExecutionTime);

        if (!empty($contents)) {
            CacheHelper::deleteUserFields(null, 'contents');
        }

        //update last execution time to current time
        Cache::store(ConfigService::$cacheDriver)->delete('expireCacheCommand');

        Cache::store(ConfigService::$cacheDriver)->rememberForever(
            'expireCacheCommand',
            function ()  {
                return Carbon::now()->toDateTimeString();
            });

        return true;
    }
}