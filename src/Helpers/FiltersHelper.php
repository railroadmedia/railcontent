<?php

namespace Railroad\Railcontent\Helpers;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;

/**
 * FiltersHelper class is responsible for preparing and managing filters for content retrieval.
 * It processes incoming request data to set up filters based on various criteria such as user states, content
 * statuses, scheduling, and more.
 *
 * @package Railroad\Railcontent\Helpers
 * @author Riza Roxana
 * @version 1.0
 */
class FiltersHelper
{

    public static $includedFields = [];
    public static $requiredFields = [];
    public static $requiredUserStates = [];
    public static $futureScheduledContentOnly = false;
    public static $groupBy = null;

    /**
     * Prepares filters fields based on the incoming request data.
     *
     * @return void
     */
    public static function prepareFiltersFields()
    {
        $request = request();

        // Set fields based on request inputs
        self::$includedFields = $request->input('included_fields', []);
        self::$requiredFields = $request->input('required_fields', []);
        self::$requiredUserStates = $request->input('required_user_states', []);
        self::$futureScheduledContentOnly = ContentRepository::$getFutureScheduledContentOnly;

        // Process statuses, future content, count filter items, and enrollment options
        self::processStatuses($request);
        self::processFutureContentOptions($request);
        self::processCountFilterItems($request);
        self::processEnrollmentOptions($request);

        // Process other filters based on request inputs
        self::processAdditionalFilters($request);

        if ($request->input('sort') == '-score') {
            $request->merge(['sort' => '-published_on']);
        }
    }

    /**
     * Sets the required fields for the content retrieval.
     *
     * @param string $field The field to be set as required.
     * @return void
     */
    public static function setRequiredFields($field)
    {
        self::$requiredFields = array_merge(request('required_fields', []), [$field]);
    }

    private static function processStatuses($request)
    {
        if ($request->has('statuses')) {
            ContentRepository::$availableContentStatues = $request->input('statuses');
        }
    }

    private static function processFutureContentOptions($request)
    {
        if ($request->has('include_future_content')) {
            ContentRepository::$pullFutureContent = $request->input('include_future_content');
        }

        if ($request->input('include_future_scheduled_content_only') !== 'false') {
            ContentRepository::$pullFutureContent = true;
            self::$futureScheduledContentOnly = true;
        }

        if ($request->has('future')) {
            ContentRepository::$pullFutureContent = true;
        }
    }

    private static function processCountFilterItems($request)
    {
        if ($request->has('count_filter_items')) {
            ContentRepository::$countFilterOptionItems = 1;
        }
    }

    private static function processEnrollmentOptions($request)
    {
        if ($request->has('without_enrollment')) {
            ContentRepository::$getEnrollmentContent = !$request->input('without_enrollment');
        }

        if ($request->input('only_from_my_list') == "true") {
            $userPlaylistsService = app()->make(UserPlaylistsService::class);
            $myList = $userPlaylistsService->getUserPlaylist(
                user()->id,
                'user-playlist',
                config('railcontent.brand')
            );
            ContentRepository::$includedInPlaylistsIds =
                $myList->pluck('id')
                    ->toArray();
        }
    }

    private static function processAdditionalFilters($request)
    {
        // Process 'term' filter
        if ($request->has('term')) {
            self::$requiredFields[] = 'name,%'.$request->input('term').'%,string,like';
        }

        // Process 'is_all' filter
        if ($request->input('is_all') === "true") {
            self::$requiredFields[] =
                'published_on,'.
                Carbon::now()
                    ->subMonth(3)
                    ->toDateTimeString().
                ',date,>=';
        }

        // Process other filters based on 'tabs' input
        if ($tabs = $request->input('tabs', $request->input('tab', false))) {
            $tabs = is_array($tabs) ? $tabs : [$tabs];
            foreach ($tabs as $tab) {
                // Process each tab filter
                self::processTabFilter($tab);
            }
        }

        // Process 'title' filter
        if ($request->has('title')) {
            self::processTitleFilter($request);
        }
    }

    /**
     * @param $tab
     */
    private static function processTabFilter($tab)
    {
        $extra = explode(',', $tab);
        if ($extra[0] == 'group_by') {
            self::$groupBy = $extra[1];
        }
        if ($extra[0] == 'duration') {
            self::$requiredFields[] = 'length_in_seconds,'.$extra[1].',integer,'.$extra[2].',video';
        }
        if ($extra[0] == 'length_in_seconds' || $extra[0] == 'topic') {
            self::$requiredFields[] = $tab;
        }
        if (count($extra) == 1 && $extra[0] == 'complete') {
            self::$requiredUserStates[] = 'completed';
        }
        if (count($extra) == 1 && $extra[0] == 'inProgress') {
            self::$requiredUserStates[] = 'started';
        }
    }

    /**
     * @param $request
     */
    private static function processTitleFilter($request)
    {
        $title = $request->input('title');
        if (self::$groupBy == 'artist' || self::$groupBy == 'style') {
            self::$requiredFields[] = self::$groupBy.',%'.$title.'%,string,like';
        } elseif (self::$groupBy == 'instructor') {
            self::processInstructorFilter($title);
        } else {
            self::processMultipleFieldFilter($title);
        }
    }

    private static function processInstructorFilter($title)
    {
        $contentService = app()->make(ContentService::class);
        $instructors = $contentService->getWhereTypeInAndStatusAndField(
            ['instructor'],
            'published',
            'name',
            '%'.$title.'%',
            'string',
            'LIKE'
        )
            ->pluck('id')
            ->toArray();
        if (empty($instructors)) {
            self::$requiredFields[] = 'instructor,0,integer,=';
        }
        foreach ($instructors as $instructor) {
            self::$includedFields[] = 'instructor,'.$instructor.',integer,=';
        }
    }

    private static function processMultipleFieldFilter($title)
    {
        $contentService = app()->make(ContentService::class);
        $instructors = $contentService->getWhereTypeInAndStatusAndField(
            ['instructor'],
            'published',
            'name',
            '%'.$title.'%',
            'string',
            'LIKE'
        )
            ->pluck('id')
            ->toArray();
        $instructorIds = implode('-', $instructors);
        self::$includedFields[] = 'title|artist|album|genre|instructor,%'.$title.'%,string,like,'.$instructorIds;
    }
}