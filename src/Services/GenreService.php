<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\GenreRepository;

class GenreService
{

    public $genreRepository;

    /**
     * @param GenreRepository $genreRepository
     */
    public function __construct(
        GenreRepository $genreRepository
    ) {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->genreRepository->getAll();
    }

    /**
     * @param $id
     * @return array|mixed|object|string|null
     */
    public function getById($id)
    {
        $results =

            $this->genreRepository->query()
                ->where('id', $id)
                ->get();

        return $results;
    }

    /**
     * @param $name
     * @param null $avatar
     * @return array
     */
    public function create($name, $avatar = null)
    {
        $genreId = $this->genreRepository->create([
                                                      'name' => $name,
                                                      'head_shot_picture_url' => $avatar,
                                                  ]);

        return $this->getById($genreId);
    }

    /**
     * @param $id
     * @param $name
     * @param $avatar
     * @return array|null
     */
    public function update($id, $name, $avatar)
    {
        //check if genre exist in the database
        $genre = $this->getById($id);

        if (is_null($genre)) {
            return $genre;
        }

        $this->genreRepository->update($id, ['name' => $name, 'head_shot_picture_url' => $avatar]);

        return $this->getById($id);
    }
}