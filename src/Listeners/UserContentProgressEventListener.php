<?php

namespace Railroad\Railcontent\Listeners;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
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
        $higherOrderTypes = config(
            'railcontent.content_types_and_depth_to_calculate_hierarchy_higher_key_progress',
            []
        );

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
            $level2Position = 0;

            $level1Children =
                $this->connection()
                    ->table('railcontent_content_hierarchy')
                    ->leftJoin(
                        'railcontent_user_content_progress',
                        'railcontent_user_content_progress.content_id',
                        '=',
                        'railcontent_content_hierarchy.child_id'
                    )
                    ->where('parent_id', $event->contentId)
                    ->where(
                        function (Builder $builder) use ($event) {
                            $builder->where('railcontent_user_content_progress.user_id', $event->userId)
                                ->orWhereNull('railcontent_user_content_progress.user_id');
                        }
                    )
                    ->orderBy('child_position', 'asc')
                    ->get()
                    ->keyBy('child_position');

            foreach ($level1Children as $level1Child) {
                if ($level1Child->state == 'completed' && $level1Position < count($level1Children)) {
                    $level1Position++;
                }
            }

            $level1ChildrenCurrentChild = $level1Children[$level1Position] ?? null;

            if (!empty($level1ChildrenCurrentChild)) {
                $level2Children =
                    $this->connection()
                        ->table('railcontent_content_hierarchy')
                        ->leftJoin(
                            'railcontent_user_content_progress',
                            'railcontent_user_content_progress.content_id',
                            '=',
                            'railcontent_content_hierarchy.child_id'
                        )
                        ->where('parent_id', $level1ChildrenCurrentChild->child_id)
                        ->where(
                            function (Builder $builder) use ($event) {
                                $builder->where('railcontent_user_content_progress.user_id', $event->userId)
                                    ->orWhereNull('railcontent_user_content_progress.user_id');
                            }
                        )
                        ->orderBy('child_position', 'asc')
                        ->get()
                        ->keyBy('child_position');

                foreach ($level2Children as $index => $level2Child) {
                    if ($level2Child->state != 'completed') {
                        $level2Position = $index - 1;
                        break;
                    }
                }
            };

            // set
            $this->userContentProgressRepository->updateOrCreate(
                [
                    'content_id' => $event->contentId,
                    'user_id' => $event->userId,
                ],
                [
                    'higher_key_progress' => $level1Position . '.' . $level2Position,
                    'updated_on' => Carbon::now()
                        ->toDateTimeString(),
                ]
            );
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