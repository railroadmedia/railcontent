<?php

namespace Modules\Mentor\Controllers;

use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\HelpScoutMentorService;
use App\Modules\Mentor\Services\MentorService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;

class MentorController extends Controller
{
    private MentorService $mentorService;
    private HelpScoutMentorService $service;

    public function __construct(MentorService $mentorService, HelpScoutMentorService $service)
    {
        $this->mentorService = $mentorService;
        $this->service = $service;
    }

    public function getMentorIdByStudent(Request $request, $userId)
    {
        return $this->mentorService->getMentorIdByStudent($userId);
    }

    public function getMentors(Request $request)
    {
        Log::info('test');
        Log::info('test');
        Log::info('test');
        Log::info('test');
        Log::info('test');
        Log::info('.....');

        return Mentor::all()->map(
            fn(Mentor $mentor) => ['mentorUserId' => $mentor->user->id, 'displayName' => $mentor->user->display_name]
        );
    }

    public function updateStudentMentor(Request $request)
    {
        $userId = $request->input('userId');
        $newMentorId = $request->input('mentorUserId');
        $this->mentorService->updateStudentMentor($userId, $newMentorId);
    }

    public function getMentorsPaged(Request $request, $page)
    {
        $searchTerm = $request->input('searchTerm');
        $query = Mentor::query()
            ->from('mentors as m')
            ->join('usora_users as u', 'u.id', '=', 'm.user_id')
            ->select(['m.*', 'u.display_name', 'u.profile_picture_url', 'u.email']);
        if ($searchTerm) {
            $query = $query->where('u.display_name', 'like', "%$searchTerm%")
                ->orWhere('u.email', 'like', "%$searchTerm%")
                ->orWhere('m.supported_brands', 'like', "%$searchTerm%");
        }

        $result = $query->orderBy('m.user_id')
            ->paginate(page: $page, perPage: 25);
        return $result;
    }

    public function getMentor(Request $request, $userId)
    {
        return $this->mentorService->getMentorOrNull($userId);
    }

    public function updateMentor(Request $request)
    {
        $userId = $request->input('userId');
        $supportedBrands = $request->input('supportedBrands');
        $activeStudentMaxCount = $request->input('activeStudentMaxCount');
        $this->mentorService->updateMentor($userId, $supportedBrands, $activeStudentMaxCount);
    }

    public function demoteMentor(Request $request, $userId)
    {
        $mentorStudents = $this->mentorService->delete($userId);
        return $mentorStudents->map(fn($mentorStudent) => $mentorStudent->user->email);
    }
}
