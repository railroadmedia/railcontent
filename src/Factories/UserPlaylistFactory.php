<?php

namespace Railroad\Railcontent\Factories;

use Railroad\Railcontent\Services\PlaylistsService;

class UserPlaylistFactory extends FactoryBase
{
    /**
     * @var PlaylistsService
     */
    private $playlistsService;

    /**
     * ContentFactory constructor.
     *
     * @param PlaylistsService $playlistsService
     */
    public function __construct(PlaylistsService $playlistsService)
    {
        parent::__construct();

        $this->playlistsService = $playlistsService;
    }

    /**
     * @param array $parameterOverwrites
     * @return array
     */
    public function create(array $parameterOverwrites)
    {
        $parameters =
            $parameterOverwrites + [
                $this->faker->randomNumber(),
                $this->faker->randomNumber(),
                $this->faker->randomNumber()
            ];

        ksort($parameters);

        return $this->playlistsService->addToPlaylist(...$parameters);
    }
}