<?php

namespace App\Modules\HelpScout\Commands;

use App\Modules\HelpScout\Services\HelpScoutWebHookService;
use Illuminate\Console\Command;

class RegisterWebHook extends Command
{

    protected $signature = 'helpscout:register {url : Endpoint for webhook} {event : web hook event}';
    protected $description = 'Register web hook';
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
        $url = $this->argument('url');
        $event = $this->argument('event');

        $this->info("\nRegistering web hook $url");
        $this->helpScoutWebHookService->registerWebHook($url, [$event]);
        return true;
    }


}
