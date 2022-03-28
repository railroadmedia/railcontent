<?php

namespace Railroad\Railcontent\Listeners;

use Carbon\Carbon;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Services\UserContentProgressService;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;

class UserContentProgressEventListener extends Event
{
    /**
     * @var UserContentProgressService
     */
    private $userContentProgressService;

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * UserContentProgressEventListener constructor.
     *
     * @param UserContentProgressService $userContentProgressService
     * @param DatabaseManager $databaseManager
     * @param RailcontentEntityManager $entityManager
     */
    public function __construct(
        UserContentProgressService $userContentProgressService,
        DatabaseManager $databaseManager,
        RailcontentEntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
        $this->userContentProgressService = $userContentProgressService;
        $this->databaseManager = $databaseManager;
    }

    /**
     * @param UserContentProgressSaved $event
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handle(UserContentProgressSaved $event)
    {
        if ($event->bubble) {
            $this->userContentProgressService->bubbleProgress($event->user, $event->content);
        }

        // if the parent type is in the higher order progress array, set the higher order progress
        $higherOrderTypes = config(
            'railcontent.content_types_and_depth_to_calculate_hierarchy_higher_key_progress',
            []
        );

        if (empty($higherOrderTypes)) {
            return;
        }

        // get the content type
        $type = $event->content->getType();

        if (!empty($type) && in_array($type, $higherOrderTypes)) {
            $level1Position = 1;
            $level2Position = 1;

            $methodIsCompleted =
                $this->connection()
                            ->table('railcontent_user_content_progress')
                                ->where('railcontent_user_content_progress.user_id', $event->userId)
                                ->where('railcontent_user_content_progress.content_id', $event->contentId)
                                ->where('railcontent_user_content_progress.state', 'completed')
                                ->first();

            if ($methodIsCompleted) {
                $lastLevel1Children =
                    $this->connection()
                        ->table('railcontent_content_hierarchy')
                        ->join('railcontent_content', 'child_id','=','railcontent_content.id')
                        ->where('parent_id', $event->contentId)
                        ->where('railcontent_content.status','=','published')
                        ->orderBy('child_position', 'desc')
                        ->first();

                $level1Position = $lastLevel1Children->child_position;

                $lastLevel2Children =
                    $this->connection()
                        ->table('railcontent_content_hierarchy')
                        ->join('railcontent_content', 'child_id','=','railcontent_content.id')
                        ->where('parent_id', $lastLevel1Children->child_id)
                        ->where('railcontent_content.status','=','published')
                        ->orderBy('child_position', 'desc')
                        ->first();

                $level2Position = $lastLevel2Children->child_position;

            } else {
                $level1Children =
                    $this->connection()
                        ->table('railcontent_content_hierarchy')
                        ->leftJoin('railcontent_user_content_progress', function (JoinClause $join) use ($event) {
                            $join->on(
                                'railcontent_user_content_progress.content_id',
                                '=',
                                'railcontent_content_hierarchy.child_id'
                            )
                                ->where(function (Builder $builder) use ($event) {
                                    $builder->where(
                                        'railcontent_user_content_progress.user_id',
                                        $event->userId
                                    );
                                });
                        })
                        ->where('parent_id', $event->contentId)
                        ->orderBy('child_position', 'asc')
                        ->get()
                        ->keyBy('child_position');

                foreach ($level1Children as $index => $level1Child) {
                    if ($level1Child->state != 'completed') {
                        $level1Position = $index;
                        break;
                    }
                }

                $level1ChildrenCurrentChild = $level1Children[$level1Position] ?? null;

                if (!empty($level1ChildrenCurrentChild)) {
                    $level2Children =
                        $this->connection()
                            ->table('railcontent_content_hierarchy')
                            ->leftJoin('railcontent_user_content_progress', function (JoinClause $join) use ($event) {
                                $join->on(
                                    'railcontent_user_content_progress.content_id',
                                    '=',
                                    'railcontent_content_hierarchy.child_id'
                                )
                                    ->where(function (Builder $builder) use ($event) {
                                        $builder->where(
                                            'railcontent_user_content_progress.user_id',
                                            $event->userId
                                        );
                                    });
                            })
                            ->where('parent_id', $level1ChildrenCurrentChild->child_id)
                            ->orderBy('child_position', 'asc')
                            ->get()
                            ->keyBy('child_position');

                    foreach ($level2Children as $index => $level2Child) {
                        if ($level2Child->state != 'completed') {
                            $level2Position = $index;
                            break;
                        }
                    }
                }
            }

            $userContentProgress =
                array_first($this->userContentProgressService->getUserProgressOnContent(
                    $event->user,
                    $event->content
                ));

            if (!$userContentProgress) {
                $userContentProgress = new UserContentProgress();
                $userContentProgress->setContent($event->content);
                $userContentProgress->setUser($event->user);
                $userContentProgress->setProgressPercent($event->progressPercent);
                $userContentProgress->setState($event->progressStatus);
            }

            $userContentProgress->setHigherKeyProgress($level1Position . '.' . $level2Position);
            $userContentProgress->setUpdatedOn(Carbon::parse(now()));

            $this->entityManager->persist($userContentProgress);

            $this->entityManager->flush();
        }

    }

    /**
     * @return \Illuminate\Database\Connection
     */
    private function connection()
    {
        return $this->databaseManager->connection(config('railcontent.database_connection_name'));
    }
}