<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Events\ContentSoftDeleted;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Events\ElasticDataShouldUpdate;
use Railroad\Railcontent\Events\HierarchyUpdated;

//use Railroad\Railcontent\Events\XPModified;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\CommentAssignmentRepository;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Repositories\ContentBpmRepository;
use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Repositories\ContentFieldRepository;
use Railroad\Railcontent\Repositories\ContentFollowsRepository;
use Railroad\Railcontent\Repositories\ContentHierarchyRepository;
use Railroad\Railcontent\Repositories\ContentInstructorRepository;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\ContentStyleRepository;
use Railroad\Railcontent\Repositories\ContentTopicRepository;
use Railroad\Railcontent\Repositories\ContentVersionRepository;
use Railroad\Railcontent\Repositories\QueryBuilders\ElasticQueryBuilder;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Support\Collection;

class RailcontentV2DataSyncingService
{
    /**
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * @var ContentVersionRepository
     */
    private $versionRepository;

    /**
     * @var ContentFieldRepository
     */
    private $fieldRepository;

    /**
     * @var ContentDatumRepository
     */
    private $datumRepository;

    /**
     * @var ContentHierarchyRepository
     */
    private $contentHierarchyRepository;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var CommentAssignmentRepository
     */
    private $commentAssignationRepository;

    /**
     * @var ContentPermissionRepository
     */
    private $contentPermissionRepository;

    /**
     * @var UserContentProgressRepository
     */
    private $userContentProgressRepository;

    /**
     * @var UserPermissionsRepository
     */
    private $userPermissionRepository;
    /**
     * @var ContentFollowsRepository
     */
    private $contentFollowRepository;

    /**
     * @var ElasticService
     */
    private $elasticService;
    /**
     * @var ContentTopicRepository
     */
    private $contentTopicRepository;
    /**
     * @var ContentInstructorRepository
     */
    private $contentInstructorRepository;
    /**
     * @var ContentStyleRepository
     */
    private $contentStyleRepository;

    private $contentBpmRepository;

    // all possible content statuses
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_ARCHIVED = 'archived';
    const STATUS_DELETED = 'deleted';

    private $idContentCache = [];

    /**
     * @param ContentRepository $contentRepository
     * @param ContentVersionRepository $versionRepository
     * @param ContentFieldRepository $fieldRepository
     * @param ContentDatumRepository $datumRepository
     * @param ContentHierarchyRepository $contentHierarchyRepository
     * @param ContentPermissionRepository $contentPermissionRepository
     * @param CommentRepository $commentRepository
     * @param CommentAssignmentRepository $commentAssignmentRepository
     * @param UserContentProgressRepository $userContentProgressRepository
     * @param UserPermissionsRepository $userPermissionsRepository
     * @param ContentFollowsRepository $contentFollowsRepository
     * @param ElasticService $elasticService
     * @param ContentTopicRepository $contentTopicRepository
     * @param ContentInstructorRepository $contentInstructorRepository
     * @param ContentStyleRepository $contentStyleRepository
     * @param ContentBpmRepository $contentBpmRepository
     */
    public function __construct(
        ContentRepository $contentRepository,
        ContentVersionRepository $versionRepository,
        ContentFieldRepository $fieldRepository,
        ContentDatumRepository $datumRepository,
        ContentHierarchyRepository $contentHierarchyRepository,
        ContentPermissionRepository $contentPermissionRepository,
        CommentRepository $commentRepository,
        CommentAssignmentRepository $commentAssignmentRepository,
        UserContentProgressRepository $userContentProgressRepository,
        UserPermissionsRepository $userPermissionsRepository,
        ContentFollowsRepository $contentFollowsRepository,
        ElasticService $elasticService,
        ContentTopicRepository $contentTopicRepository,
        ContentInstructorRepository $contentInstructorRepository,
        ContentStyleRepository $contentStyleRepository,
        ContentBpmRepository $contentBpmRepository
    ) {
        $this->contentRepository = $contentRepository;
        $this->versionRepository = $versionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->datumRepository = $datumRepository;
        $this->contentHierarchyRepository = $contentHierarchyRepository;
        $this->contentPermissionRepository = $contentPermissionRepository;
        $this->commentRepository = $commentRepository;
        $this->commentAssignationRepository = $commentAssignmentRepository;
        $this->userContentProgressRepository = $userContentProgressRepository;
        $this->userPermissionRepository = $userPermissionsRepository;
        $this->contentFollowsRepository = $contentFollowsRepository;
        $this->elasticService = $elasticService;
        $this->contentTopicRepository = $contentTopicRepository;
        $this->contentInstructorRepository = $contentInstructorRepository;
        $this->contentStyleRepository = $contentStyleRepository;
        $this->contentBpmRepository = $contentBpmRepository;
    }

    public function syncContentId($contentId, $forUserId = null)
    {
        if (!empty($forUserId)) {
            // --- content hierarchy rows to sync:
            // current_child_content_id
            // current_child_content_index
            // current_child_content_url
            // next_child_content_id
            // next_child_content_index
            // next_child_content_url
        }

        // --- content rows to sync:
        // album
        // artist
        // associated_user_id
        // avatar_url
        // bands
        // cd_tracks
        // chord_or_scale
        // difficulty
        // difficulty_range
        // endorsements
        // episode_number
        // exercise_book_pages
        // fast_bpm
        // forum_thread_id
        // high_soundslice_slug
        // high_video
        // home_staff_pick_rating
        // includes_song
        // is_active
        // is_coach
        // is_coach_of_the_month
        // is_featured
        // is_house_coach
        // length_in_seconds
        // live_event_start_time
        // live_event_end_time
        // live_event_youtube_id
        // live_stream_feed_type
        // low_soundslice_slug
        // low_video
        // name
        // original_video
        // pdf
        // pdf_in_g
        // qna_video
        // show_in_new_feed
        // slow_bpm
        // song_name
        // soundslice_slug
        // soundslice_xml_file_url
        // staff_pick_rating
        // student_id
        // title
        // transcriber_name
        // video
        // vimeo_video_id
        // youtube_video_id
        // xp
        // week
        // released
        // total_xp
        // popularity
        // web_url
        // mobile_url
        // child_count
        // hierarchy_position_number
        // like_count

    }
}
