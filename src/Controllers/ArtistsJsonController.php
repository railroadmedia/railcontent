<?php

namespace Railroad\Railcontent\Controllers;

use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Services\ArtistService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Transformers\DataTransformer;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Routing\Controller;

class ArtistsJsonController extends Controller
{
    private $artistService;

    /**
     * @param ArtistService $artistService
     */
    public function __construct(
        ArtistService $artistService
    ) {
        $this->artistService = $artistService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $artists = $this->artistService->getAll();

        return reply()->json($artists, [
                                         'transformer' => DataTransformer::class,
                                     ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getArtist($id)
    {
        $artist = $this->artistService->getById($id);

        return reply()->json($artist, [
                                        'transformer' => DataTransformer::class,
                                    ]);
    }

    /**
     * Create a new artist and return it in JSON format
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $artist = $this->artistService->create(
            $request->input('name'),
            $request->input('avatar')
        );

        return reply()->json([$artist], [
                                          'transformer' => DataTransformer::class,
                                      ]);
    }

    /**
     * Update an artist if exist and return it in JSON format
     *
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function update($id, Request $request)
    {
        $artist = $this->artistService->update(
            $id,
            $request->input('name'),
            $request->input('avatar')
        );

        throw_unless(
            $artist,
            new NotFoundException('Update failed, artist not found with id: '.$id)
        );

        return reply()->json([$artist], [
                                          'transformer' => DataTransformer::class,
                                          'code' => 201,
                                      ]);
    }
}
