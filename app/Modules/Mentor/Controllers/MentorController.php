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
    private $mentorService;

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

    }

}
