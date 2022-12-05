<?php

namespace Railroad\Railcontent\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\RequestSongRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\UserRequestedSongsService;

class RequestedSongsJsonController extends Controller
{
    private UserRequestedSongsService $userRequestedSongsService;

    public function __construct(
        UserRequestedSongsService $userRequestedSongsService
    ) {
        $this->userRequestedSongsService = $userRequestedSongsService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestSong(RequestSongRequest $request)
    {
        $song = $this->userRequestedSongsService->updateOrCeate([
                                                                    'user_id' => auth()->id(),
                                                                    'song' => $request->input('song_name'),
                                                                    'artist' => $request->input('artist_name'),
                                                                    'brand' => config('railcontent.brand')
                                                                ], [
                                                                    'created_at' => Carbon::now()
                                                                        ->toDateTimeString(),
                                                                ]);
        return response()->json(['success']);
    }
}
