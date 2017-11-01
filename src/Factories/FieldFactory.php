<?php

namespace Railroad\Railcontent\Factories;

use Railroad\Railcontent\Services\FieldService;

class FieldFactory extends FactoryBase
{
    /**
     * @var FieldService
     */
    private $fieldService;

    /**
     * ContentFactory constructor.
     *
     * @param FieldService $fieldService
     * @internal param ContentService $contentService
     */
    public function __construct(FieldService $fieldService)
    {
        parent::__construct();

        $this->fieldService = $fieldService;
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
                rand(),
                $this->faker->word
            ];

        ksort($parameters);

        return $this->fieldService->createField(...$parameters);
    }
}