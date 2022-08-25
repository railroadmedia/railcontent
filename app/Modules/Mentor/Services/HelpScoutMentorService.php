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
        if (!app()->isProduction()) {
            throw new Exception("Can only use this method to register production web hook");
        }
        $this->helpScoutWebHookService->registerWebHook(
            $url,
            ['convo.created']
        );
    }

    public function newHelpScoutConversation(int $conversationId, int $helpScoutCustomerId, $helpScoutEmail): void
    {
        Log::debug("");
        Log::debug("New help scout conversation $conversationId from customer $helpScoutCustomerId $helpScoutEmail");
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
        $this->updateConversationAssignedUser($conversationId, $mentorHelpScoutUserId);
    }

    private function updateConversationAssignedUser(int $conversationId, int $helpScoutUserId): void
    {
        if (app()->isProduction()) {
            $this->helpScoutUserService->updateConversationAssignedUser($conversationId, $helpScoutUserId);
        } else {
            Log::info(
                "Suppressed update to helpscout to assign user $helpScoutUserId to conversation $conversationId."
            );
        }
    }


}
