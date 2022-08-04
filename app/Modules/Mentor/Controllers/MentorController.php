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

    public function getMentorsPaged(Request $request, $page)
    {
        $searchTerm = $request->input('searchTerm');
        $query = Mentor::query()
            ->from('mentors as m')
            ->join('usora_users as u', 'u.id', '=', 'm.user_id')
            ->select(['m.*', 'u.display_name', 'u.profile_picture_url', 'u.email']);;
        if ($searchTerm) {
            $query = $query->where('u.display_name', 'like', "%$searchTerm%")
                ->orWhere('u.email', 'like', "%$searchTerm%")
                ->orWhere('m.supported_brands', 'like', "%$searchTerm%");
        }

        //dd($query->toSql());
        $result = $query->paginate(page: $page, perPage: 25);
        return $result;
    }
}
