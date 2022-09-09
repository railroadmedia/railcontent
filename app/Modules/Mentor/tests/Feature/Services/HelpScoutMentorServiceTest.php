<?php

namespace App\Modules\Mentor\tests\Feature\Services;

use App\Modules\Mentor\Services\HelpScoutMentorService;
use Tests\TestCase;

class HelpScoutMentorServiceTest extends TestCase
{

    private HelpScoutMentorService $helpScoutMentorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->helpScoutMentorService = app(HelpScoutMentorService::class);
    }

    public function test_register_webhook()
    {
        $this->helpScoutMentorService->registerHelpScoutWebHook();
    }

}
