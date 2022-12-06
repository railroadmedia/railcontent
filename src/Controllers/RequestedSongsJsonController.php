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
                                                                    'brand' => config('railcontent.brand'),
                                                                ], [
                                                                    'created_at' => Carbon::now()
                                                                        ->toDateTimeString(),
                                                                ]);
        $message = [
            'success-message' => 'Success! Your song request has been submitted.',
        ];
        
        if ($request->expectsJson()) {
            return response()->json(array_merge(['success' => true], $message));
        } else {
            return $request->has('redirect') ?
                redirect()
                    ->away($request->get('redirect'))
                    ->with($message) :
                redirect()
                    ->back()
                    ->with($message);
        }
    }
}
