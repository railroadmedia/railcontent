<?php

namespace Modules\Mentor\Controllers;

use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Providers\MentorServiceProvider;
use App\Modules\Mentor\Services\MentorService;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MentorController extends Controller
{
    private MentorService $mentorService;

    public function __construct(MentorService $mentorService)
    {
        $this->mentorService = $mentorService;
    }

    public function make(Request $request, $userId)
    {
        $this->mentorService->store($userId);
    }

    public function assign(Request $request, $userId)
    {
        $this->mentorService->assignMentor($userId);
    }

    public function getMentorIdByStudent(Request $request, $userId)
    {
        return $this->mentorService->getMentorIdByStudent($userId);
    }

    public function getMentors(Request $request)
    {
        return Mentor::all()->map(
            fn(Mentor $mentor) => ['mentorUserId' => $mentor->user->id, 'displayName' => $mentor->user->display_name]
        );
    }

    public function updateMentor(Request $request)
    {
        $userId = $request->input('userId');
        $newMentorId = $request->input('mentorUserId');
        $this->mentorService->updateMentor($userId, $newMentorId);
    }

}
