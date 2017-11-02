<?php

namespace Railroad\Railcontent\Factories;


use Railroad\Railcontent\Services\UserContentProgressService;

class UserContentProgressFactory extends UserContentProgressService
{
    /**
     * @param array $parameterOverwrites
     * @return mixed
     */
    public function create(array $parameterOverwrites = [])
    {
        $parameters =
            $parameterOverwrites + [
                $this->faker->randomNumber(),
                $this->faker->randomNumber(),
                $this->faker->randomElement(
                    [
                        UserContentProgressService::STATE_STARTED,
                        UserContentProgressService::STATE_COMPLETED
                    ]
                )
            ];

        ksort($parameters);
        $userContentId = $this->userContentService->startContent(...$parameters);
        if (last($parameters) == UserContentProgressService::STATE_COMPLETED) {
            $userContentId = $this->userContentService->completeContent(...$parameters);
        }

        return $userContentId;


    }
}