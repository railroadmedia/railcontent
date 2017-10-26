<?php

namespace Railroad\Railcontent\Factories;

use Railroad\Railcontent\Services\DatumService;

class DatumFactory extends FactoryBase
{

    /**
     * @var DatumService
     */
    private $datumService;

    /**
     * DatumFactory constructor.
     * @param DatumService $datumService
     */
    public function __construct(DatumService $datumService)
    {
        parent::__construct();

        $this->datumService = $datumService;
    }


    /**
     * @param array $parameterOverwrites
     * @return array
     */
    public function create(array $parameterOverwrites)
    {
        $parameters =
            $parameterOverwrites + [
                rand(),
                $this->faker->word,
                $this->faker->word,
                rand()
            ];

        ksort($parameters);

        return $this->datumService->createDatum(...$parameters);
    }
}