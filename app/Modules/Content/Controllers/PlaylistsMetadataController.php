<?php

namespace App\Modules\Content\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\UserManagementSystem\Models\User;
use Railroad\MusoraApi\Contracts\ProductProviderInterface;
use Railroad\Railcontent\Services\UserPermissionsService;

class PlaylistsMetadataController extends Controller
{
    public function getUserPlaylists(Request $request, ?User $user = null): JsonResponse
    {
        $user = $user ?? user();
        $results = [];
        return response()->json($results);
    }


}
