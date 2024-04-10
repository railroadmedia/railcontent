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
     * @param $id
     * @return array
     */
    public function get($id)
    {
        return $this->genreRepository->getById($id);
    }

    /**
     * @param $id
     * @return array
     */
    public function getByName($name)
    {
        return $this->genreRepository->query()
            ->where('name', '=', $name)
            ->first();
    }
}