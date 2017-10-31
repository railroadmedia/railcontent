<?php

namespace Railroad\Railcontent\Factories;

use Railroad\Railcontent\Services\ContentDatumService;

class ContentDatumFactory extends FactoryBase
{

    /**
     * @var ContentDatumService
     */
    private $datumService;

    /**
     * DatumFactory constructor.
     *
     * @param ContentDatumService $datumService
     */
    public function __construct(ContentDatumService $datumService)
    {
        parent::__construct();

        $this->datumService = $datumService;
    }


    /**
     * @param array $parameterOverwrites
     * @return array
     */
    public function create(array $parameterOverwrites = [])
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