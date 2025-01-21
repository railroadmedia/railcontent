<?php

namespace App\Modules\MusoraApi\Controllers\V5;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\UserManagementSystem\Models\User;

class UserStatisticsController extends Controller
{
    public function index(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        return response()->json([
            'totalXp' => $user->getBrandTotalXp(),
            'brand_minutes_practiced' => $user->getBrandMinutesPracticed(),
        ], Response::HTTP_OK);
    }
}
