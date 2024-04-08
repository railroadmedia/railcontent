<?php

namespace Railroad\Railcontent\Controllers;

use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Services\ArtistService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\GenreService;
use Railroad\Railcontent\Transformers\DataTransformer;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Routing\Controller;

class GenreJsonController extends Controller
{
    private $genreService;

    /**
     * @param GenreService $genreService
     */
    public function __construct(
        GenreService $genreService
    ) {
        $this->genreService = $genreService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $genre = $this->genreService->getAll();

        return reply()->json($genre, [
                                         'transformer' => DataTransformer::class,
                                     ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getGenre($id)
    {
        $genre = $this->genreService->getById($id);

        return reply()->json($genre, [
                                        'transformer' => DataTransformer::class,
                                    ]);
    }

    /**
     * Create a new genre and return it in JSON format
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $genre = $this->genreService->create(
            $request->input('name'),
            $request->input('avatar')
        );

        return reply()->json([$genre], [
                                          'transformer' => DataTransformer::class,
                                      ]);
    }

    /**
     * Update genre if exist and return it in JSON format
     *
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function update($id, Request $request)
    {
        $genre = $this->genreService->update(
            $id,
            $request->input('name'),
            $request->input('avatar')
        );

        throw_unless(
            $genre,
            new NotFoundException('Update failed, genre not found with id: '.$id)
        );

        return reply()->json([$genre], [
                                          'transformer' => DataTransformer::class,
                                          'code' => 201,
                                      ]);
    }
}
