<?php

namespace App\Modules\EventDataSynchronizer\Listeners;

use App\Maps\ContentTypes;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Services\ContentProgressService;
use App\Modules\EventDataSynchronizer\Providers\UserProviderInterface;
use App\Modules\RailTracker\Services\ContentEngagementService;
use App\Modules\Tracker\Models\MediaPlaybackTypes;
use App\Services\UserMetricsService;
use Illuminate\Support\Facades\Log;
use Railroad\Points\Services\UserPointsService;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Events\CommentDeleted;
use Railroad\Railcontent\Events\CommentLiked;
use Railroad\Railcontent\Events\CommentUnLiked;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Events\UserContentsProgressReset;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\CommentLikeService;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use App\Modules\RailTracker\Events\MediaPlaybackTracked;
use App\Modules\RailTracker\Repositories\MediaPlaybackRepository;
use Railroad\Railcontent\Events\HigherKeyProgressUpdated;

class ContentProgressEventListener
{
    public function __construct(
        private readonly ContentProgressService $contentProgressService,
        private ContentHierarchyService $contentHierarchyService,
        private ContentService $contentService,
        private CommentService $commentService,
        private CommentLikeService $commentLikeService,
        private ContentRepository $contentRepository,
        private UserPointsService $userPointsService,
        private UserProviderInterface $userProvider,
        private MediaPlaybackRepository $mediaPlaybackRepository,
        private UserMetricsService $userMetricsService,
        private UserPlaylistsService $userPlaylistsService,
        private ContentEngagementService $contentEngagementService,
    ) {
    }

    public function handleUserProgressSaved(UserContentProgressSaved $userContentProgressSaved)
    {
        $content = $this->contentService->getById($userContentProgressSaved->contentId);

        if (!empty($content)) {
            $this->userPlaylistsService->updatePlaylistsLastProgress($content['id'], brand());

            $state = ContentHelper::getUserContentProgressState($userContentProgressSaved->userId, $content);
            $percent = ContentHelper::getUserContentProgressPercent($userContentProgressSaved->userId, $content);

            // -----------------------------------
            // award xp
            // course
            if ($content['type'] == 'course') {
                $pointAmount = $content->fetch('fields.xp', config('xp_ranks.course_content_completed'));
                if (($percent == 100 || $state == 'completed')) {
                    $this->userPointsService->setPoints(
                        $userContentProgressSaved->userId,
                        [
                            'content_id' => $content['id'],
                            'progress_state' => 'completed',
                        ],
                        'course_content_completed',
                        $pointAmount,
                        'Awarded per complete course.',
                        brand()
                    );
                } else {
                    $this->userPointsService->deletePoints($userContentProgressSaved->userId, [
                        'content_id' => $content['id'],
                        'progress_state' => 'completed',
                    ]);
                }
            }

            // semester pack
            if ($content['type'] == 'semester-pack') {
                $pointAmount = $content->fetch('fields.xp', config('xp_ranks.pack_content_completed'));
                if (($percent == 100 || $state == 'completed')) {
                    $this->userPointsService->setPoints(
                        $userContentProgressSaved->userId,
                        [
                            'content_id' => $content['id'],
                            'progress_state' => 'completed',
                        ],
                        'pack_content_completed',
                        $pointAmount,
                        'Awarded per complete pack.',
                        brand()
                    );
                } else {
                    $this->userPointsService->deletePoints($userContentProgressSaved->userId, [
                        'content_id' => $content['id'],
                        'progress_state' => 'completed',
                    ]);
                }
            }

            // pack
            if ($content['type'] == 'pack') {
                $pointAmount = $content->fetch('fields.xp', config('xp_ranks.pack_content_completed'));
                if (($percent == 100 || $state == 'completed')) {
                    $this->userPointsService->setPoints(
                        $userContentProgressSaved->userId,
                        [
                            'content_id' => $content['id'],
                            'progress_state' => 'completed',
                        ],
                        'pack_content_completed',
                        $pointAmount,
                        'Awarded per complete pack.',
                        brand()
                    );
                } else {
                    $this->userPointsService->deletePoints($userContentProgressSaved->userId, [
                        'content_id' => $content['id'],
                        'progress_state' => 'completed',
                    ]);
                }
            }

            // pack bundle
            if ($content['type'] == 'pack-bundle') {
                $pointAmount = $content->fetch('fields.xp', config('xp_ranks.pack_bundle_content_completed'));
                if (($percent == 100 || $state == 'completed')) {
                    $this->userPointsService->setPoints(
                        $userContentProgressSaved->userId,
                        [
                            'content_id' => $content['id'],
                            'progress_state' => 'completed',
                        ],
                        'pack_bundle_content_completed',
                        $pointAmount,
                        'Awarded per complete pack dvd/bundle.',
                        brand()
                    );
                } else {
                    $this->userPointsService->deletePoints($userContentProgressSaved->userId, [
                        'content_id' => $content['id'],
                        'progress_state' => 'completed',
                    ]);
                }
            }

            // learning path
            if ($content['type'] == 'learning-path') {
                $pointAmount = $content->fetch('fields.xp', config('xp_ranks.learning_path_content_completed'));
                if (($percent == 100 || $state == 'completed')) {
                    $this->userPointsService->setPoints(
                        $userContentProgressSaved->userId,
                        [
                            'content_id' => $content['id'],
                            'progress_state' => 'completed',
                        ],
                        'learning_path_content_completed',
                        $pointAmount,
                        'Awarded per complete learning path.',
                        brand()
                    );
                } else {
                    $this->userPointsService->deletePoints($userContentProgressSaved->userId, [
                        'content_id' => $content['id'],
                        'progress_state' => 'completed',
                    ]);
                }
            }

            // learning path level
            if ($content['type'] == 'learning-path-level') {
                $pointAmount = $content->fetch('fields.xp', config('xp_ranks.learning_path_level_content_completed'));
                if (($percent == 100 || $state == 'completed')) {
                    $this->userPointsService->setPoints(
                        $userContentProgressSaved->userId,
                        [
                            'content_id' => $content['id'],
                            'progress_state' => 'completed',
                        ],
                        'learning_path_content_level_completed',
                        $pointAmount,
                        'Awarded per complete learning path level.',
                        brand()
                    );
                } else {
                    $this->userPointsService->deletePoints($userContentProgressSaved->userId, [
                        'content_id' => $content['id'],
                        'progress_state' => 'completed',
                    ]);
                }
            }

            // learning path course
            if ($content['type'] == 'learning-path-course') {
                $pointAmount = $content->fetch('fields.xp', config('xp_ranks.learning_path_course_content_completed'));
                if (($percent == 100 || $state == 'completed')) {
                    $this->userPointsService->setPoints(
                        $userContentProgressSaved->userId,
                        [
                            'content_id' => $content['id'],
                            'progress_state' => 'completed',
                        ],
                        'learning_path_content_course_completed',
                        $pointAmount,
                        'Awarded per complete learning path course.',
                        brand()
                    );
                } else {
                    $this->userPointsService->deletePoints($userContentProgressSaved->userId, [
                        'content_id' => $content['id'],
                        'progress_state' => 'completed',
                    ]);
                }
            }

            // learning path lesson
            if ($content['type'] == 'learning-path-lesson') {
                $pointAmount = $content->fetch('fields.xp', config('xp_ranks.learning_path_lesson_content_completed'));
                if (($percent == 100 || $state == 'completed')) {
                    $this->userPointsService->setPoints(
                        $userContentProgressSaved->userId,
                        [
                            'content_id' => $content['id'],
                            'progress_state' => 'completed',
                        ],
                        'learning_path_content_lesson_completed',
                        $pointAmount,
                        'Awarded per complete learning path lesson.',
                        brand()
                    );
                } else {
                    $this->userPointsService->deletePoints($userContentProgressSaved->userId, [
                        'content_id' => $content['id'],
                        'progress_state' => 'completed',
                    ]);
                }
            }

            // assignment
            if ($content['type'] == 'assignment') {
                $pointAmount = $content->fetch('fields.xp', config('xp_ranks.assignment_content_completed'));
                if (($percent == 100 || $state == 'completed')) {
                    $this->userPointsService->setPoints(
                        $userContentProgressSaved->userId,
                        [
                            'content_id' => $content['id'],
                            'progress_state' => 'completed',
                        ],
                        'assignment_content_completed',
                        $pointAmount,
                        'Awarded per complete assignment.',
                        brand()
                    );
                } else {
                    $this->userPointsService->deletePoints($userContentProgressSaved->userId, [
                        'content_id' => $content['id'],
                        'progress_state' => 'completed',
                    ]);
                }
            }

            // other singular lesson types
            if (in_array(
                $content['type'],
                ContentTypes::singularContentTypes()
            )) {
                $pointAmount =
                    config('xp_ranks.difficulty_xp_map')[$content->fetch('fields.difficulty')]
                    ??
                    config('xp_ranks.difficulty_xp_map.all');

                // if xp is set in the field use that instead of the preconfigured defaults
                $pointAmount = $content->fetch('fields.xp', $pointAmount);

                if (($percent == 100 || $state == 'completed')) {
                    $this->userPointsService->setPoints(
                        $userContentProgressSaved->userId,
                        [
                            'content_id' => $content['id'],
                            'progress_state' => 'completed',
                        ],
                        str_replace('-', '_', $content['type']) . '_content_completed',
                        $pointAmount,
                        'Awarded per complete ' . str_replace('-', ' ', $content['type']) . '.',
                        brand()
                    );
                } else {
                    $this->userPointsService->deletePoints($userContentProgressSaved->userId, [
                        'content_id' => $content['id'],
                        'progress_state' => 'completed',
                    ]);
                }
            }

            $this->userProvider->saveExperiencePoints(
                $userContentProgressSaved->userId,
                $this->userPointsService->countUserPointsPerBrand(
                    $userContentProgressSaved->userId
                )
            );
        }
    }

    private function getContentId(MediaPlaybackTracked $mediaPlaybackTracked)
    {
        $contentId = intval($mediaPlaybackTracked->contentId);
        if ($contentId) {
            return $contentId;
        }

        //Sometimes contentId is not provided and we need to look up id from media id
        $contentId = Content::query()->select('id')
            ->where('external_video_id', '=', $mediaPlaybackTracked->mediaId)
            ->first()?->id;
        if ($contentId) {
            return $contentId;
        }

        $videoContentId = Content::query()->select('id')
            ->where('vimeo_video_id', '=', $mediaPlaybackTracked->mediaId)
            ->orWhere('youtube_video_id', '=', $mediaPlaybackTracked->mediaId)
            ->first()?->id;
        if ($videoContentId) {
            $contentId = Content::query()->select('id')
                ->where('video', '=', $videoContentId)
                ->first()?->id;
            if ($contentId) {
                return $contentId;
            }
        }
        $contentId = intval($mediaPlaybackTracked->mediaId);
        if ($contentId && $contentId < 100000000) {
            //assume these ids are content id and not vimeo ids
            return $contentId;
        }
        return null;
    }

    public function handleMediaPlaybackTracked(MediaPlaybackTracked $mediaPlaybackTracked)
    {
        $contentId = $this->getContentId($mediaPlaybackTracked);
        if (!$contentId) {
            Log::warning("Unable to get contentId from mediaId $mediaPlaybackTracked->mediaId");
        }
        $brand = in_array($mediaPlaybackTracked->brand, config('brands', []))
            ? $mediaPlaybackTracked->brand
            : config('railcontent.brand');

        if ($contentId) {
            $this->contentEngagementService->update(
                $mediaPlaybackTracked->userId,
                $contentId,
                $mediaPlaybackTracked->currentSecond
            );
        } else {
            $userId = user()->id;
            Log::info("handleMediaPlaybackTracked $userId");
            //Log::debug(print_r($mediaPlaybackTracked, true));
        }
        $assignmentTypeIds = $this->mediaPlaybackRepository->getAssignmentTypeIds();

        if (in_array($mediaPlaybackTracked->typeId, $assignmentTypeIds) && $mediaPlaybackTracked->secondsPlayed > 0) {
            //            $min = $this->userMetricsService->getTotalMinutesPracticed(
            //                $mediaPlaybackTracked->userId,
            //                $assignmentTypeIds
            //            );
            $userBrandMinutesPracticed = user()->brand_minutes_practiced;
            $initialValue = $userBrandMinutesPracticed[$brand] ?? 0;
            $min = ($initialValue + round($mediaPlaybackTracked->secondsPlayed / 60, 0));
            $userBrandMinutesPracticed[$brand] = $min;
            user()->brand_minutes_practiced = $userBrandMinutesPracticed;
            user()->save();
        }

        $media = new MediaPlaybackTypes();
        $dbCon = config('railtracker.database_connection_name');
        $media->setConnection($dbCon);
        $soundslice = $media->where('category', '=', 'soundslice')->first();
        $playAlong = $media->where('category', '=', 'play-alongs')->first();

        // sound slice assignment
        if ($soundslice && ($mediaPlaybackTracked->typeId == $soundslice->id)) {
            $maxMinutesToTrack = 600;

            $totalTimeWatchedSeconds = (int)$this->mediaPlaybackRepository->sumTotalPlayed(
                $mediaPlaybackTracked->userId,
                $mediaPlaybackTracked->mediaId,
                $mediaPlaybackTracked->typeId
            );

            if ($totalTimeWatchedSeconds <= $maxMinutesToTrack) {
                $minutes = floor($totalTimeWatchedSeconds / 60);
                $totalAmount = 0;
                while ($minutes > 0) {
                    $this->userPointsService->setPoints(
                        $mediaPlaybackTracked->userId,
                        [
                            'content_id' => $mediaPlaybackTracked->mediaId,
                            'minutes_watched' => $minutes,
                        ],
                        'per_minute_of_assignment_practiced',
                        config('xp_ranks.per_minute_of_assignment_practiced'),
                        'Awarded for every minute of an assignment practiced watched.',
                        $brand
                    );

                    $totalAmount = $totalAmount + config('xp_ranks.per_minute_of_assignment_practiced');

                    $minutes--;
                }
            }
            $this->userProvider->saveExperiencePoints(
                $mediaPlaybackTracked->userId,
                $this->userPointsService->countUserPointsPerBrand(
                    $mediaPlaybackTracked->userId
                )
            );

            return;
        }

        // play along song
        if ($playAlong && ($mediaPlaybackTracked->typeId == $playAlong->id)) {
            $maxMinutesToTrack = 600;

            $totalTimeWatchedSeconds = (int)$this->mediaPlaybackRepository->sumTotalPlayed(
                $mediaPlaybackTracked->userId,
                $mediaPlaybackTracked->mediaId,
                $mediaPlaybackTracked->typeId
            );

            if ($totalTimeWatchedSeconds <= $maxMinutesToTrack) {
                $minutes = floor($totalTimeWatchedSeconds / 60);
                $totalAmount = 0;
                while ($minutes > 0) {
                    $this->userPointsService->setPoints(
                        $mediaPlaybackTracked->userId,
                        [
                            'content_id' => $mediaPlaybackTracked->mediaId,
                            'minutes_watched' => $minutes,
                        ],
                        'per_minute_of_play_along_practiced',
                        config('xp_ranks.per_minute_of_play_along_practiced'),
                        'Awarded for every minute of a play-along practiced watched.',
                        $brand
                    );

                    $totalAmount = $totalAmount + config('xp_ranks.per_minute_of_play_along_practiced');

                    $minutes--;
                }

                $this->userProvider->saveExperiencePoints(
                    $mediaPlaybackTracked->userId,
                    $this->userPointsService->countUserPointsPerBrand(
                        $mediaPlaybackTracked->userId
                    )
                );
            }

            return;
        }


        if ($contentId) {
            $lengthInSeconds = (int)$mediaPlaybackTracked->mediaLengthInSeconds;

            $totalTimeWatchedSeconds = (int)$this->mediaPlaybackRepository->sumTotalPlayed(
                $mediaPlaybackTracked->userId,
                $mediaPlaybackTracked->mediaId,
                $mediaPlaybackTracked->typeId
            );
            $minutes = floor(min($totalTimeWatchedSeconds, $lengthInSeconds) / 60);
            if ($minutes > 0) {
                $points = $minutes * config('xp_ranks.per_minute_content_watched');

                $this->userPointsService->setPoints(
                    $mediaPlaybackTracked->userId,
                    [
                        'content_id' => $contentId,
                        'minutes_watched' => 'all',
                    ],
                    'minutes_of_content_watched_v2',
                    $points,
                    null, //unnecessary use of space here, could infer it from trigger name
                    $brand
                );

                $this->userProvider->saveExperiencePoints(
                    $mediaPlaybackTracked->userId,
                    $this->userPointsService->countUserPointsPerBrand(
                        $mediaPlaybackTracked->userId
                    )
                );
            }


            if ($mediaPlaybackTracked->mediaLengthInSeconds > 0) {
                $this->contentProgressService->saveContentProgress(
                    $contentId,
                    min(
                        round(
                            $mediaPlaybackTracked->currentSecond / $mediaPlaybackTracked->mediaLengthInSeconds * 100
                        ),
                        99
                    ),
                    $mediaPlaybackTracked->userId
                );
            }
        }
    }

    public function handleReset(UserContentsProgressReset $userContentsProgressReset)
    {
        foreach ($userContentsProgressReset->contentIds as $contentId) {
            $this->userPointsService->deletePoints($userContentsProgressReset->userId, [
                'content_id' => $contentId,
                'progress_state' => 'completed',
            ]);
        }

        $pointsPerBrand = $this->userPointsService->countUserPointsPerBrand(
            $userContentsProgressReset->userId
        );
        foreach (config('railcontent.available_brands', []) as $brand) {
            if (!isset($pointsPerBrand[$brand])) {
                $pointsPerBrand[$brand] = 0;
            }
        }
        $this->userProvider->saveExperiencePoints(
            $userContentsProgressReset->userId,
            $pointsPerBrand
        );
    }

    public function handleCommentCreated(CommentCreated $commentCreated)
    {
        /** @var CommentEntity $comment */
        $comment = $this->commentService->get($commentCreated->commentId);

        if (empty($comment)) {
            return;
        }

        $content = $this->contentService->getById($comment['content_id']);
        if (empty($content)) {
            return;
        }

        // award xp
        $this->userPointsService->setPoints(
            $comment['user_id'],
            [
                'comment_id' => $comment['id'],
                'content_id' => $comment['content_id'],
            ],
            'comment_posted',
            config('xp_ranks.comment_posted'),
            'Awarded per comment posted.'
        );

        $this->userProvider->saveExperiencePoints(
            $comment['user_id'],
            $this->userPointsService->countUserPointsPerBrand(
                $comment['user_id']
            )
        );
    }

    public function handleCommentDeleted(CommentDeleted $commentDeleted)
    {
        $comment = $this->commentService->get($commentDeleted->commentId);

        if (empty($comment)) {
            return;
        }

        // remove xp
        $this->userPointsService->deletePoints($comment['user_id'], [
            'comment_id' => $comment['id'],
            'content_id' => $comment['content_id'],
        ]);

        // chunk delete points for all the comment likes
        $page = 1;

        do {
            $commentLikes = $this->commentLikeService->getCommentLikesPaginated($comment['id'], 250, $page)['results'];

            $hashes = [];

            foreach ($commentLikes as $commentLike) {
                $hashes[] = $this->userPointsService->hash([
                    'comment_id' => $comment['id'],
                    'comment_liker_user_id' => $commentLike['user_id'],
                ]);
            }

            $this->userPointsService->repository()
                ->query()
                ->whereIn('trigger_hash', $hashes)
                ->delete();

            $page++;
        } while (count($commentLikes) > 0);

        $this->userProvider->saveExperiencePoints(
            $comment['user_id'],
            $this->userPointsService->countUserPointsPerBrand(
                $comment['user_id']
            )
        );
    }

    public function handleCommentLiked(CommentLiked $commentLiked)
    {
        $comment = $this->commentService->get($commentLiked->commentId);

        // award xp
        $this->userPointsService->setPoints(
            $comment['user_id'],
            [
                'comment_id' => $comment['id'],
                'comment_liker_user_id' => $commentLiked->userId,
            ],
            'comment_liked',
            config('xp_ranks.comment_liked'),
            'Awarded per comment like.'
        );

        $this->userProvider->saveExperiencePoints(
            $comment['user_id'],
            $this->userPointsService->countUserPointsPerBrand(
                $comment['user_id']
            )
        );
    }

    public function handleCommentUnLiked(CommentUnLiked $commentUnLiked)
    {
        $comment = $this->commentService->get($commentUnLiked->commentId);

        // remove xp
        $this->userPointsService->deletePoints($comment['user_id'], [
            'comment_id' => $comment['id'],
            'comment_liker_user_id' => $commentUnLiked->userId,
        ]);

        $this->userProvider->saveExperiencePoints(
            $comment['user_id'],
            $this->userPointsService->countUserPointsPerBrand(
                $comment['user_id']
            )
        );
    }

    public function handleHeighKeyProgressUpdates(HigherKeyProgressUpdated $event)
    {
        $userBrandMethodLevels = user()->brand_method_levels;
        $brand = config('railcontent.brand');
        $userBrandMethodLevels[$brand] = $event->higherKeyProgress;
        $content = $this->contentService->getById($event->contentId);
        //only brand method should be stored
        if ($content['slug'] == $brand . '-method') {
            user()->brand_method_levels = $userBrandMethodLevels;
            user()->save();
        }
    }
}
