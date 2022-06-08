<?php

namespace Railroad\Railcontent\Decorators\UserProgress;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Support\Collection;

class ContentUserProgressDecorator implements DecoratorInterface
{
    /**
     * @var UserContentProgressRepository
     */
    protected $userContentProgressRepository;

    /**
     * @var UserContentProgressService
     */
    protected $userContentProgressService;

    /**
     * CommentLikesDecorator constructor.
     * @param UserContentProgressRepository $userContentProgressRepository
     * @param UserContentProgressService $userContentProgressService
     */
    public function __construct(
        UserContentProgressRepository $userContentProgressRepository,
        UserContentProgressService $userContentProgressService
    ) {
        $this->userContentProgressRepository = $userContentProgressRepository;
        $this->userContentProgressService = $userContentProgressService;
    }

    public function decorate(Collection $contents, $userId = null)
    {
        if (empty($userId) && !empty(auth()->id())) {
            $userId = auth()->id();
        }

        if (empty($userId)) {
            return $contents;
        }

        $contentIds = [];

        foreach ($contents as $content) {
            $contentIds[] = $content['id'];
        }

        $contents = $contents->toArray();

        if (!empty($contentIds)) {
            $contentProgressions =
                $this->userContentProgressRepository->getByUserIdAndWhereContentIdIn($userId, $contentIds);

            $contentProgressionsByContentId = [];

            foreach ($contentProgressions as $contentProgression) {
                if (isset($contentProgressionsByContentId[$contentProgression['content_id']])) {
                    if (($contentProgression['state'] == 'started' &&
                        $contentProgressionsByContentId[$contentProgression['content_id']]['state'] == 'completed')) {
                        $contentProgressionsByContentId[$contentProgression['content_id']] = $contentProgression;

                        $this->userContentProgressRepository->query()
                            ->where(
                                [
                                    'content_id' => $contentProgression['content_id'],
                                    'user_id' => $contentProgression['user_id'],
                                    'state' => 'started'
                                ]
                            )
                            ->delete();

                        $this->userContentProgressService->completeContent(
                            $contentProgression['content_id'],
                            $contentProgression['user_id']
                        );
                    }

                    if (($contentProgression['state'] == 'completed' &&
                        $contentProgressionsByContentId[$contentProgression['content_id']]['state'] == 'started')) {
                        $contentProgressionsByContentId[$contentProgression['content_id']] = $contentProgression;

                        $this->userContentProgressRepository->query()
                            ->where(
                                [
                                    'content_id' => $contentProgressionsByContentId[$contentProgression['content_id']]['content_id'],
                                    'user_id' => $contentProgressionsByContentId[$contentProgression['content_id']]['user_id'],
                                    'state' => 'started'
                                ]
                            )
                            ->delete();

                        $this->userContentProgressService->completeContent(
                            $contentProgressionsByContentId[$contentProgression['content_id']]['content_id'],
                            $contentProgressionsByContentId[$contentProgression['content_id']]['user_id']
                        );

                        $contentProgressionsByContentId[$contentProgression['content_id']] = $contentProgression;
                    }
                } else {
                    $contentProgressionsByContentId[$contentProgression['content_id']] = $contentProgression;
                }
            }

            foreach ($contents as $index => $content) {
                if (!empty($contentProgressionsByContentId[$content['id']])) {
                    $contents[$index]['user_progress'][$userId] = $contentProgressionsByContentId[$content['id']];

                    $contents[$index][UserContentProgressService::STATE_COMPLETED] =
                        $contentProgressionsByContentId[$content['id']]['state'] ==
                        UserContentProgressService::STATE_COMPLETED;

                    $contents[$index][UserContentProgressService::STATE_STARTED] =
                        $contentProgressionsByContentId[$content['id']]['state'] ==
                        UserContentProgressService::STATE_STARTED;

                    $contents[$index]['progress_percent'] =
                        $contentProgressionsByContentId[$content['id']]['progress_percent'];
                } else {
                    $contents[$index]['user_progress'][$userId] = [];

                    $contents[$index][UserContentProgressService::STATE_COMPLETED] = false;
                    $contents[$index][UserContentProgressService::STATE_STARTED] = false;
                    $contents[$index]['progress_percent'] = 0;
                }

                $contents[$index]['higher_key_progress'] =
                    $contentProgressionsByContentId[$content['id']]['higher_key_progress'] ?? '';
            }
        }

        return new Collection($contents);
    }
}