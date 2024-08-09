<?php

namespace App\Modules\HelpScout\Console\Commands;

use App\Modules\HelpScout\Services\HelpScoutWebHookService;
use Illuminate\Console\Command;

class UnregisterWebHook extends Command
{
    protected $signature = 'helpscout:unregister {url : Endpoint for webhook}';
    protected $description = 'Unregister web hook';
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
        $url = $this->argument('url');

        $this->info("\nUnregistering web hook $url");
        $this->helpScoutWebHookService->unregister($url);
        return true;
    }


}
