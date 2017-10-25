<?php

namespace Railroad\Railcontent\Factories;


use Railroad\Railcontent\Services\UserContentService;

class UserStateFactory extends FactoryBase
{
    /**
     * @var UserContentService
     */
    private $userContentService;

    /**
     * UserStateFactory constructor.
     * @param $userContentService
     */
    public function __construct(UserContentService $userContentService)
    {
        parent::__construct();

        $this->userContentService = $userContentService;
    }

    /**
     * @param array $parameterOverwrites
     * @return mixed
     */
    public function create(array $parameterOverwrites)
    {
        $parameters =
            $parameterOverwrites + [
                $this->faker->randomNumber(),
                $this->faker->randomNumber(),
                $this->faker->randomElement(
                    [
                        UserContentService::STATE_STARTED,
                        UserContentService::STATE_COMPLETED
                    ]
                )
            ];

        ksort($parameters);
        $userContentId = $this->userContentService->startContent(...$parameters);
        if (last($parameters) == UserContentService::STATE_COMPLETED) {
            $userContentId = $this->userContentService->completeContent(...$parameters);
        }

        return $userContentId;


    }
}