<?php

namespace App\Modules\HelpScout\Console\Commands;

use HelpScout\Api\Mailboxes\Mailbox;
use App\Modules\HelpScout\Services\HelpScoutService;
use Illuminate\Console\Command;

class GetMailBoxes extends Command
{
    protected $signature = 'helpscout:getMailBoxes';
    protected $description = 'Get mail boxes';
    private HelpScoutService $helpScoutService;

    public function __construct(HelpScoutService $helpScoutService)
    {
        parent::__construct();
        $this->helpScoutService = $helpScoutService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): int
    {
        $this->info("\nGetting mail boxes");
        $mailBoxes = $this->helpScoutService->getMailBoxes();
        /* @var Mailbox $mailBox */
        foreach ($mailBoxes as $mailBox) {
            $this->info("id: {$mailBox->getId()} name: {$mailBox->getName()} email: {$mailBox->getEmail()} ");
        }
        return true;
    }


}
