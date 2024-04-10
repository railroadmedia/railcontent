<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ArtistRepository;

class ArtistService
{

    public $artistRepository;

    /**
     * @param ArtistRepository $artistRepository
     */
    public function __construct(
        ArtistRepository $artistRepository
    ) {
        $this->artistRepository = $artistRepository;
    }

    /**
     * @param $id
     * @return array
     */
    public function get($id)
    {
        return $this->artistRepository->getById($id);
    }

    /**
     * @param $id
     * @return array
     */
    public function getByName($name)
    {
        return $this->artistRepository->query()->where('name','=',$name)->first();
    }
}