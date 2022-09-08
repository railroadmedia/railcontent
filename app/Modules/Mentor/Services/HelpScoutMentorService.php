<?php

namespace App\Modules\Mentor\Services;


use App\Modules\HelpScout\Services\HelpScoutUserService;
use App\Modules\HelpScout\Services\HelpScoutWebHookService;
use Exception;
use Illuminate\Support\Facades\Log;

class HelpScoutMentorService
{
    private HelpScoutWebHookService $helpScoutWebHookService;
    private MentorService $mentorService;
    private HelpScoutUserService $helpScoutUserService;

    public function __construct(
        HelpScoutWebHookService $helpScoutWebHookService,
        MentorService $mentorService,
        HelpScoutUserService $helpScoutUserService,
    ) {
        $this->helpScoutWebHookService = $helpScoutWebHookService;
        $this->mentorService = $mentorService;
        $this->helpScoutUserService = $helpScoutUserService;
    }

    public function registerHelpScoutWebHook(): void
    {
        $url = route('helpscout_conversation_new');
        Log::info("Registering help scout route $url");
        $this->helpScoutWebHookService->registerWebHook(
            $url,
            ['convo.created']
        );
    }

    public function unregisterHelpScoutWebHook(): void
    {
        $url = route('helpscout_conversation_new');
        Log::info("Unregistering help scout route $url");
        $this->helpScoutWebHookService->unregister($url);
    }

    public function newHelpScoutConversation(int $conversationId, int $helpScoutCustomerId, $helpScoutEmail, int $mailboxId): void
    {
        Log::debug("");
        Log::debug("New help scout conversation $conversationId from customer $helpScoutCustomerId $helpScoutEmail mailbox $mailboxId");

        if(!in_array($mailboxId, config('mentor.helpscout_mailboxes'))){
            Log::debug("Not watching helpscout mailbox $mailboxId");
            return;
        }

        $userId = $this->helpScoutUserService->getUserIdFromHelpScoutCustomerInfo(
            $helpScoutCustomerId,
            $helpScoutEmail
        );
        if (!$userId) {
            Log::info("Unable to find user for helpscout customer $helpScoutCustomerId $helpScoutEmail");
            return;
        }
        Log::debug("User Id: $userId");
        $mentorUserId = $this->mentorService->getMentorIdByStudent($userId);
        if (!$mentorUserId) {
            Log::info("User $userId has no assigned mentor");
            return;
        }
        $mentorHelpScoutUserId = $this->helpScoutUserService->getHelpScoutUserIdFromUserId($mentorUserId);
        $this->helpScoutUserService->updateConversationAssignedUser($conversationId, $mentorHelpScoutUserId);
    }


}
