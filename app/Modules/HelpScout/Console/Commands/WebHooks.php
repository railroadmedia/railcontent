<?php

namespace App\Modules\HelpScout\Console\Commands;

use App\Modules\HelpScout\Services\HelpScoutWebHookService;
use Illuminate\Console\Command;

class WebHooks extends Command
{
    protected $signature = 'helpscout:webhooks';
    protected $description = 'Get web hooks';
    private HelpScoutWebHookService $helpScoutWebHookService;

    public function __construct(HelpScoutWebHookService $helpScoutWebHookService)
    {
        parent::__construct();
        $this->helpScoutWebHookService = $helpScoutWebHookService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): int
    {
        $this->info("\nGetting web hooks");
        $webHooks = $this->helpScoutWebHookService->getWebHooks();
        $webHooks->each(function ($webHook) {
            $this->info(print_r($webHook, true));
            $this->info("r mwp artisan helpscout:unregister {$webHook['url']}");
        });
        if($webHooks->count() == 0) {
            $this->info("\nNo web hooks found");
        }
        return true;
    }


}
