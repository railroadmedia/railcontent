<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Services\UserContentProgressService;

class UserContentProgressDecorator implements DecoratorInterface
{
    /**
     * @var UserContentProgressRepository
     *
     */
    private $userContentProgressReposiory;

    /**
     * UserContentProgressDecorator constructor.
     *
     * @param UserContentProgressRepository $userContentProgressReposiory
     */
    public function __construct(UserContentProgressRepository $userContentProgressReposiory)
    {
        $this->userContentProgressReposiory = $userContentProgressReposiory;
    }

    /**
     * @param array $entities
     * @return array
     */
    public function decorate(array $entities)
    : array {

        if (empty(auth()->id())) {
            return $entities;
        }

        $entityIds = [];
        foreach ($entities as $entity) {
            $entityIds[] = $entity->getId();
        }

        $contentProgressions =
            $this->userContentProgressReposiory->getByUserIdAndWhereContentIdIn(auth()->id(), $entityIds);

        $contentProgressionsByContentId = [];

        foreach ($contentProgressions as $contentProgression) {
            $contentProgressionsByContentId[$contentProgression->getContent()
                ->getId()] = $contentProgression;
        }

        foreach ($entities as $index => $content) {
            if (!empty($contentProgressionsByContentId[$content->getId()])) {

                $content->createProperty(
                    'progress_percent',
                    $contentProgressionsByContentId[$content->getId()]->getProgressPercent()
                );

                $content->createProperty(
                    'user_progress',
                    [
                        auth()->id() => $contentProgressionsByContentId[$content->getId()],
                    ]
                );

                $content->createProperty(
                    'progress_state',
                         $contentProgressionsByContentId[$content->getId()]->getState()
                );

                $content->createProperty(
                    'user_progress_updated_on',
                        $contentProgressionsByContentId[$content->getId()]->getUpdatedOn()
                );

                $content->createProperty(
                    UserContentProgressService::STATE_COMPLETED,
                    $contentProgressionsByContentId[$content->getId()]->getState() ==
                    UserContentProgressService::STATE_COMPLETED
                );

                $content->createProperty(
                    UserContentProgressService::STATE_STARTED,
                    $contentProgressionsByContentId[$content->getId()]->getState() ==
                    UserContentProgressService::STATE_STARTED
                );
            } else {
                $content->createProperty(
                    'user_progress',
                    [
                        auth()->id() => [],
                    ]
                );

                $content->createProperty(
                    'progress_state',
                    false
                );

                $content->createProperty(
                    'progress_percent',
                    0
                );
                $content->createProperty(
                    UserContentProgressService::STATE_COMPLETED,
                    false
                );
                $content->createProperty(
                    UserContentProgressService::STATE_STARTED,
                    false
                );
            }
        }
        return $entities;
    }
}
