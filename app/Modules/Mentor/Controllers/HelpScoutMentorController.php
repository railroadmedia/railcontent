<?php

namespace Modules\Mentor\Controllers;

use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\HelpScoutMentorService;
use App\Modules\Mentor\Services\HelpScoutWebHookService;
use App\Modules\Mentor\Services\MentorService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class HelpScoutMentorController extends Controller
{
    private HelpScoutMentorService $helpScoutMentorService;

    public function __construct(HelpScoutMentorService $helpScoutMentorService)
    {
        $this->helpScoutMentorService = $helpScoutMentorService;
    }

    public function newHelpScoutConversation(Request $request)
    {
        try {
            $conversationId = $request->input("id");
            $helpScoutUserId = $request->input('createdBy.id');
            $helpScoutUserEmail = $request->input('createdBy.email') ?? '';
            $helpScoutMailBoxId = $request->input('mailboxId');
            $this->helpScoutMentorService->newHelpScoutConversation($conversationId, $helpScoutUserId,
                $helpScoutUserEmail, $helpScoutMailBoxId);
        } catch (Throwable $exception) {
            //need to return success to helpscout or it may disable the webhook if too many failures occur
            Log::error($exception);
        }
    }


}
