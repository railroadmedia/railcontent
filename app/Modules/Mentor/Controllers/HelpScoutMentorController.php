<?php

namespace Modules\Mentor\Controllers;

use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\HelpScoutMentorService;
use App\Modules\Mentor\Services\HelpScoutWebHookService;
use App\Modules\Mentor\Services\MentorService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HelpScoutMentorController extends Controller
{
    private HelpScoutMentorService $helpScoutMentorService;

    public function __construct(HelpScoutMentorService $helpScoutMentorService)
    {
        $this->helpScoutMentorService = $helpScoutMentorService;
    }

    public function newHelpScoutConversation(Request $request)
    {
        $conversationId = $request->input("id");
        $helpScoutUserId = $request->input('createdBy.id');
        $helpScoutUserEmail = $request->input('createdBy.email') ?? '';
        $this->helpScoutMentorService->newHelpScoutConversation($conversationId, $helpScoutUserId, $helpScoutUserEmail);
    }


}
