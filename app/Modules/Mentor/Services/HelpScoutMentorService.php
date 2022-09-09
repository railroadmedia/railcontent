<?php

namespace App\Modules\Mentor\Services;


class HelpScoutMentorService
{
    private HelpScoutWebHookService $helpScoutWebHookService;

    public function __construct(HelpScoutWebHookService $helpScoutWebHookService)
    {
        $this->helpScoutWebHookService = $helpScoutWebHookService;
    }

    public function registerHelpScoutWebHook()
    {
        $this->helpScoutWebHookService->registerWebHook(
            "https://webhook.site/f91a694c-ebb8-4a67-baf5-e9d489664b8e",
            ['convo.created']
        );
    }
}
