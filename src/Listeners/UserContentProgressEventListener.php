<?php

namespace Railroad\Railcontent\Listeners;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Services\UserContentProgressService;

class UserContentProgressEventListener extends Event
{
    private $userContentProgressService;

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var $userContentProgressRepository
     */
    private $userContentProgressRepository;

    public function __construct(
        UserContentProgressService $userContentProgressService,
        DatabaseManager $databaseManager,
        UserContentProgressRepository $userContentProgressRepository
    ) {
        $this->userContentProgressService = $userContentProgressService;
        $this->databaseManager = $databaseManager;
        $this->userContentProgressRepository = $userContentProgressRepository;
    }

    public function handle(UserContentProgressSaved $event)
    {
        if ($event->bubble) {
            $this->userContentProgressService->bubbleProgress($event->userId, $event->contentId);
        }

        // if the parent type is in the higher order progress array, set the higher order progress
        $higherOrderTypes =
            config('railcontent.content_types_and_depth_to_calculate_hierarchy_higher_key_progress', []);

        if (empty($higherOrderTypes)) {
            return;
        }

        // get the content type
        $type =
            $this->connection()
                ->table('railcontent_content')
                ->where('id', $event->contentId)
                ->get(['type'])
                ->first()->type ?? null;

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
                        ->where('parent_id', $event->contentId)
                        ->orderBy('child_position', 'desc')
                        ->first();
                $level1Position = $lastLevel1Children->child_position;

                $lastLevel2Children =
                    $this->connection()
                        ->table('railcontent_content_hierarchy')
                        ->where('parent_id', $lastLevel1Children->child_id)
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
                                    $builder->where('railcontent_user_content_progress.user_id', $event->userId);
                                });
                        })
                        ->where('parent_id', $event->contentId)
                        ->where(function (Builder $builder) use ($event) {
                            $builder->where('railcontent_user_content_progress.state', 'started')
                                ->orWhereNull('railcontent_user_content_progress.state');
                        })
                        ->orderBy('child_position', 'asc')
                        ->first();

                if (!empty($level1Children)) {
                    $level1Position = $level1Children->child_position;

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
                                        $builder->where('railcontent_user_content_progress.user_id', $event->userId);
                                    });
                            })
                            ->where('parent_id', $level1Children->child_id)
                            ->orderBy('child_position', 'asc')
                            ->get()
                            ->keyBy('child_position');

                    foreach ($level2Children as $index => $level2Child) {
                        if ($level2Child->state != 'completed') {
                            $level2Position = $index;
                            break;
                        }
                    }
                };
            }

            // set
            $this->userContentProgressRepository->updateOrCreate([
                                                                     'content_id' => $event->contentId,
                                                                     'user_id' => $event->userId,
                                                                 ], [
                                                                     'higher_key_progress' => $level1Position .
                                                                         '.' .
                                                                         $level2Position,
                                                                     'updated_on' => Carbon::now()
                                                                         ->toDateTimeString(),
                                                                 ]);
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