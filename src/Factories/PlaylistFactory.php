<?php

namespace Railroad\Railcontent\Factories;

use Railroad\Railcontent\Services\PlaylistsService;

class PlaylistFactory extends FactoryBase
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
    public function create(array $parameterOverwrites = [])
    {
        $parameters =
            $parameterOverwrites + [
                $this->faker->word,
                $this->faker->randomNumber(),
                $this->faker->boolean()
            ];

        ksort($parameters);

        return $this->playlistsService->store(...$parameters);
    }
}