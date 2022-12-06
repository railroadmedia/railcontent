<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\UserRequestedSongsRepository;

class UserRequestedSongsService
{
    private UserRequestedSongsRepository $userRequestedSongsRepository;

    /**
     * @param UserRequestedSongsRepository $userRequestedSongsRepository
     */
    public function __construct(
        UserRequestedSongsRepository $userRequestedSongsRepository
    ) {
        $this->userRequestedSongsRepository = $userRequestedSongsRepository;
    }

    /**
     * @param $attributes
     * @param $values
     * @return array
     */
    public function updateOrCeate($attributes, $values)
    {
        $requestedSong = $this->userRequestedSongsRepository->updateOrCreate($attributes, $values);

        return $this->userRequestedSongsRepository->getById($requestedSong);
    }
}