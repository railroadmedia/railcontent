<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Helpers\CacheHelper;
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
     * @return array
     */
    public function getAll()
    {
        $hash = 'artists_all_'.CacheHelper::getKey();
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results = CacheHelper::saveUserCache($hash, $this->artistRepository->getAll(), null);
        }

        return $results;
    }

    /**
     * @param $id
     * @return array|mixed|object|string|null
     */
    public function getById($id)
    {
        $hash = 'artist_id'.CacheHelper::getKey($id);
        $results = CacheHelper::getCachedResultsForKey($hash);

        if (!$results) {
            $results =
                CacheHelper::saveUserCache(
                    $hash,
                    $this->artistRepository->query()
                        ->where('id', $id)
                        ->get(),
                    null
                );
        }

        return $results;
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
        CacheHelper::deleteAllCachedSearchResults('artists_all_');

        return $this->get($artistId);
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
        $artist = $this->get($id);

        if (is_null($artist)) {
            return $artist;
        }

        $this->artistRepository->update($id, ['name' => $name, 'head_shot_picture_url' => $avatar]);

        CacheHelper::deleteAllCachedSearchResults('artists_all_');

        return $this->get($id);
    }
}