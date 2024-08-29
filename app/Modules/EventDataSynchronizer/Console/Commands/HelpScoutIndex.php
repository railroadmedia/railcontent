<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Modules\HelpScout\Services\HelpScoutService;
use HelpScout\Api\Exception\AuthenticationException;
use Illuminate\Console\Command;
use Throwable;

class HelpScoutIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'HelpScoutIndex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull the first customers page from helpscout API and show page info';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(HelpScoutService $helpScoutService): void
    {
        try {
            $page = $helpScoutService->getCustomersPage();

            $this->info('Pulled page #' . $page->getPageNumber());
            $this->info('total pages count: ' . $page->getTotalPageCount());
            $this->info('page size setting: ' . $page->getPageSize());
            $this->info('actual customers count on current page: ' . $page->getPageElementCount());
            $this->info('total customers count: ' . $page->getTotalElementCount());
        } catch (AuthenticationException $authenticationException) {
            $this->error(
                'AuthenticationException raised, please setup correct ENV values for keys HELPSCOUT_APP_ID and HELPSCOUT_APP_SECRET'
            );
        }
    }
}
