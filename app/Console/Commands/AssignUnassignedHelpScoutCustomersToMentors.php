<?php

namespace App\Console\Commands;

use App\Modules\HelpScout\Services\HelpScoutService;
use App\Modules\HelpScout\Services\HelpScoutUserService;
use App\Modules\Mentor\Services\HelpScoutMentorService;
use DateTime;
use HelpScout\Api\Conversations\Conversation;
use HelpScout\Api\Conversations\ConversationFilters;
use HelpScout\Api\Customers\Customer;
use HelpScout\Api\Entity\PagedCollection;
use Illuminate\Console\Command;

class AssignUnassignedHelpScoutCustomersToMentors extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'AssignUnassignedHelpScoutCustomersToMentors';

    protected $signature = 'AssignUnassignedHelpScoutCustomersToMentors';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(
        HelpScoutUserService $helpScoutUserService,
        HelpScoutMentorService $helpScoutMentorService
    ) {
        $this->info('Starting AssignUnassignedHelpScoutCustomersToMentors.');

        $filters = (new ConversationFilters())
            ->inMailbox(244819)
            ->inStatus('open')
            ->modifiedSince(new DateTime('2023-11-08'))
            ->withQuery('assigned:"Unassigned"')
            ->sortField('createdAt')
            ->sortOrder('desc');

        $totalConvosFound = 0;

        /**
         * @var $customers Conversation[]|PagedCollection
         */
        $conversations = $helpScoutUserService->getConversations($filters);

        $totalPageCount = $conversations->getTotalPageCount();

        foreach ($conversations as $conversation) {
            $helpScoutMentorService->newHelpScoutConversation(
                $conversation->getId(),
                $conversation->getCustomer()->getId(),
                $conversation->getCustomer()->getFirstEmail(),
                $conversation->getMailboxId()
            );

            $totalConvosFound++;
            $this->info('Convos processed: ' . $totalConvosFound);
        }

        while ($conversations->getPageNumber() < $totalPageCount) {
            $conversations = $conversations->getNextPage();

            foreach ($conversations as $conversation) {
                $helpScoutMentorService->newHelpScoutConversation(
                    $conversation->getId(),
                    $conversation->getCustomer()->getId(),
                    $conversation->getCustomer()->getFirstEmail(),
                    $conversation->getMailboxId()
                );

                $totalConvosFound++;
                $this->info('Convos processed: ' . $totalConvosFound);
            }
        }

        $this->info('Convos processed: ' . $totalConvosFound);

        $this->info('---------------------------------------------------');
        $this->info('Finished AssignUnassignedHelpScoutCustomersToMentors!');

        return true;
    }
}
