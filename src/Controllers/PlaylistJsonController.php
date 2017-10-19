<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\PlaylistRequest;
use Railroad\Railcontent\Requests\UserContentPlaylistRequest;
use Railroad\Railcontent\Services\PlaylistsService;

class PlaylistJsonController extends Controller
{
    protected $playlistsService;

    /**
     * PlaylistsController constructor.
     *
     * @param $playlistsService
     */
    public function __construct(PlaylistsService $playlistsService)
    {
        $this->playlistsService = $playlistsService;
    }

    /** Call the method from service that add content to playlist
     *
     * @param UserContentPlaylistRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToPlaylist(UserContentPlaylistRequest $request)
    {
        $playlist = $this->playlistsService->addToPlaylist(
            $request->input('content_id'),
            $request->input('playlist_id'),
            $request->user()->id
        );

        return response()->json($playlist, 200);
    }

    /** Call the method from service that create a new playlist (with type PUBLIC or PRIVATE)
     *
     * @param PlaylistRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PlaylistRequest $request)
    {
        $playlist = $this->playlistsService->store(
            $request->input('name'),
            $request->user()->id,
            $request->user()->is_admin
        );

        return response()->json($playlist, 200);
    }
}
