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
     * @return array
     */
    public function getAll()
    {
        return $this->artistRepository->getAll();
    }

    /**
     * @param $id
     * @return array|mixed|object|string|null
     */
    public function getById($id)
    {
        return $this->artistRepository->query()
            ->where('id', $id)
            ->get();
    }

    /**
     * @param $name
     * @param null $avatar
     * @return array
     */
    public function create($name, $avatar = null)
    {
        $artistId = $this->artistRepository->create([
                                                        'name' => $name,
                                                        'head_shot_picture_url' => $avatar,
                                                    ]);

        return $this->artistRepository->getById($artistId);
    }

    /**
     * @param $id
     * @param $name
     * @param $avatar
     * @return array|null
     */
    public function update($id, $name, $avatar)
    {
        //check if artist exist in the database
        $artist = $this->artistRepository->getById($id);

        if (is_null($artist)) {
            return $artist;
        }

        $this->artistRepository->update($id, ['name' => $name, 'head_shot_picture_url' => $avatar]);

        return $this->artistRepository->getById($id);
    }
}