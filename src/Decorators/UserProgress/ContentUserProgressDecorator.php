<?php

namespace Railroad\Railcontent\Decorators\UserProgress;


use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Support\Collection;
use Railroad\Resora\Decorators\DecoratorInterface;

class ContentUserProgressDecorator implements DecoratorInterface
{
    /**
     * @var UserContentProgressRepository
     */
    protected $userContentProgressRepository;

    /**
     * CommentLikesDecorator constructor.
     */
    public function __construct(UserContentProgressRepository $userContentProgressRepository)
    {
        $this->userContentProgressRepository = $userContentProgressRepository;
    }

    public function decorate($contents, $userId = null)
    {
        if (empty($userId) && !empty(auth()->id())) {
            $userId = auth()->id();
        }

        if (empty($userId)) {
            return $contents;
        }

        $contentIds = [];

        foreach ($contents as $content) {
            $contentIds[] = $content->fetch('id');
        }

        $contents = $contents->toArray();

        if (!empty($contentIds)) {
            $contentProgressions =
                $this->userContentProgressRepository->getByUserIdAndWhereContentIdIn($userId, $contentIds);

            $contentProgressionsByContentId =
                array_combine(array_pluck($contentProgressions, 'content_id'), $contentProgressions);

            foreach ($contents as $index => $content) {
                if (!empty($contentProgressionsByContentId[$content->fetch('id')])) {
                    $contents[$index]['user_progress'][$userId] = $contentProgressionsByContentId[$content->fetch('id')];

                    $contents[$index][UserContentProgressService::STATE_COMPLETED] =
                        $contentProgressionsByContentId[$content->fetch('id')]['state'] ==
                        UserContentProgressService::STATE_COMPLETED;

                    $contents[$index][UserContentProgressService::STATE_STARTED] =
                        $contentProgressionsByContentId[$content->fetch('id')]['state'] ==
                        UserContentProgressService::STATE_STARTED;

                    $contents[$index]['progress_percent'] = $contentProgressionsByContentId[$content->fetch('id')]['progress_percent'];
                } else {
                    $contents[$index]['user_progress'][$userId] = [];

                    $contents[$index][UserContentProgressService::STATE_COMPLETED] = false;
                    $contents[$index][UserContentProgressService::STATE_STARTED] = false;
                    $contents[$index]['progress_percent'] = 0;
                }
            }
        }

        return new Collection($contents);
    }
}