<?php

namespace App\Modules\HelpScout\Commands;

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
    public function handle()
    {
        $this->info("\nGet web hooks");
        $this->helpScoutWebHookService->getWebHooks()->each(function($webHook){
            $this->info(print_r($webHook));
        });

        return true;
    }


}
