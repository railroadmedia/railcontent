<?php

namespace Railroad\Railcontent\Helpers;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;

class FiltersHelper
{
    public static $includedFields = [];
    public static $requiredFields = [];
    public static $requiredUserStates = [];
    public static $futureScheduledContentOnly = false;
    public static $groupBy = null;

    public static function prepareFiltersFields()
    {
        self::$includedFields = request('included_fields', []);
        self::$requiredFields = request('required_fields', []);
        self::$requiredUserStates = request('required_user_states', []);

        if (request('statuses')) {
            ContentRepository::$availableContentStatues = request('statuses');
        }

        if (request('include_future_content')) {
            ContentRepository::$pullFutureContent = request('include_future_content');
        }
        if (request('count_filter_items')) {
            ContentRepository::$countFilterOptionItems = request('count_filter_items');
        }
        if (request('without_enrollment')) {
            ContentRepository::$getEnrollmentContent = !request('without_enrollment');
        }

        if (request('only_from_my_list') == "true") {
            $userPlaylistsService = app()->make(UserPlaylistsService::class);
            $myList = $userPlaylistsService->getUserPlaylist(
                user()->id,
                'user-playlist',
                config('railcontent.brand')
            );
            $myListIds = \Arr::pluck($myList, 'id');
            ContentRepository::$includedInPlaylistsIds = $myListIds;
        }

        if (request('include_future_scheduled_content_only') &&
            request('include_future_scheduled_content_only') != 'false') {
            ContentRepository::$pullFutureContent = true;
            self::$futureScheduledContentOnly = true;
        }

        if (request('term')) {
            self::$requiredFields[] = 'name,%'.request('term').'%,string,like';
            if (request('sort') == '-score') {
                request()->merge(['sort' => 'published_on']);
            }
        }

        if (request('is_all') === "true") {
            self::$requiredFields[] =
                'published_on,'.
                Carbon::now()
                    ->subMonth(3)
                    ->toDateTimeString().
                ',date,>=';
        }

        $tabs = request('tabs', request('tab', false));
        if ($tabs) {
            if (!is_array($tabs)) {
                $tabs = [$tabs];
            }
            foreach ($tabs as $tab) {
                $extra = explode(',', $tab);
                if ($extra['0'] == 'group_by') {
                    self::$groupBy = $extra['1'];
                }
                if ($extra['0'] == 'duration') {
                    self::$requiredFields[] = 'length_in_seconds,'.$extra[1].',integer,'.$extra[2].',video';
                }
                if ($extra['0'] == 'length_in_seconds' || $extra['0'] == 'topic') {
                    self::$requiredFields[] = $tab;
                }
                if (count($extra) == 1 && $extra[0] == 'complete') {
                    self::$requiredUserStates[] = 'completed';
                }
                if (count($extra) == 1 && $extra[0] == 'inProgress') {
                    self::$requiredUserStates[] = 'started';
                }
            }
        }

        if (request('title') && (self::$groupBy == 'artist' || self::$groupBy == 'style')) {
            self::$requiredFields[] = self::$groupBy.',%'.request('title').'%,string,like';
        } elseif (request('title') && self::$groupBy == 'instructor') {
            $contentService = app()->make(ContentService::class);
            $instructors = $contentService->getWhereTypeInAndStatusAndField(
                ['instructor'],
                'published',
                'name',
                '%'.request('title').'%',
                'string',
                'LIKE'
            )
                ->pluck('id')
                ->toArray();
            if (empty($instructors)) {
                self::$requiredFields[] = 'instructor,0,integer,=';
            }
            foreach ($instructors ?? [] as $instructor) {
                self::$includedFields[] = 'instructor,'.$instructor.',integer,=';
            }
        } elseif (request('title')) {
            $contentService = app()->make(ContentService::class);
            $instructors = $contentService->getWhereTypeInAndStatusAndField(
                ['instructor'],
                'published',
                'name',
                '%'.request('title').'%',
                'string',
                'LIKE'
            );

            $instructorIds = implode(
                '-',
                $instructors->pluck('id')
                    ->toArray()
            );

            self::$includedFields[] =
                'title|artist|album|genre|instructor,%'.request('title').'%,string,like,'.$instructorIds;
        }
    }

    public static function setRequiredFields($field)
    {
        self::$requiredFields = array_merge(request('required_fields', []), [$field]);
    }
}