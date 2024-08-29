<?php

namespace Modules\Mentor\Tests\Feature\Controllers;

use App\Modules\HelpScout\Models\HelpScoutCustomer;
use App\Modules\HelpScout\Models\HelpScoutUser;
use App\Modules\HelpScout\Services\HelpScoutUserService;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\MentorService;
use Illuminate\Support\Facades\Event;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class HelpScoutMentorControllerTest extends TestCase
{
    public const DEVELOPMENT_HELPSCOUT_USERID = 554771;
    public const DEVELOPMENT_HELPSCOUT_CUSTOMERID = 551120840;

    private MentorService $mentorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mentorService = app(MentorService::class);
        Event::fake();
    }

    public function test_helpscout_conversation_created_webhook(): void
    {
        $brand = 'drumeo';
        $mentor = Mentor::factory()->create(['supported_brands' => $brand]);
        $user = User::factory()->create([]);
        $this->mentorService->assignMentorByBrand($user->id, $brand);


        $helpScoutCustomer = HelpScoutCustomer::factory()->create([
            'internal_id' => $user->id,
            'external_id' => self::DEVELOPMENT_HELPSCOUT_CUSTOMERID,
        ]);
        $helpScoutUser = HelpScoutUser::factory()->create([
            'user_id' => $mentor->id,
            'helpscout_user_id' => 1234,
        ]);

        //Mock actual call to helpscout
        $mock = $this->partialMock(HelpScoutUserService::class);
        $mock->shouldReceive('updateConversationAssignedUser')->once();
        $this->app->instance(HelpScoutUserService::class, $mock);

        $path = __DIR__ . "/helpScoutConversationCreatedExampleData.json";
        $file = fopen($path, "r");
        $exampleRequestArray = json_decode(fread($file, filesize($path)), true);
        fclose($file);
        $route = config('mentor.route_prefix') . '/helpscout/conversation/new';

        $this->json('POST', $route, $exampleRequestArray)
            ->assertStatus(200);
    }
}
