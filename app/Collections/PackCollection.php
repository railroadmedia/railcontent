<?php

namespace App\Collections;

use App\Modules\Content\Services\CohortService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Entities\ContentEntity;

class PackCollection extends Collection
{
    private CohortService $cohortService;

    public function __construct($items = [])
    {
        parent::__construct($items);
        $this->cohortService = $cohortService = app()->make(CohortService::class);
    }

    public function sortPacks($userId, $direction = 'desc')
    {
        $activeContentId = $this->cohortService->getActiveCohort()?->getContentId() ?? 0;

        return $this->sort(
            function (ContentEntity $a, ContentEntity $b) use ($direction, $userId, $activeContentId) {
                //active cohort sort
                if ($activeContentId > 0) {
                    if ($a['id'] == $activeContentId) {
                        return -1;
                    }
                    if ($b['id'] == $activeContentId) {
                        return 1;
                    }
                }

                //user activity sort
                if (!empty($a['user_progress'][$userId]['updated_on'])
                    && !empty($b['user_progress'][$userId]['updated_on'])
                ) {
                    $aUpdatedOn = Carbon::parse($a['user_progress'][$userId]['updated_on']);
                    $bUpdatedOn = Carbon::parse($b['user_progress'][$userId]['updated_on']);

                    if ($direction == 'desc') {
                        return $aUpdatedOn < $bUpdatedOn ? 1 : -1;
                    } else {
                        return $aUpdatedOn > $bUpdatedOn ? 1 : -1;
                    }
                }

                if (!empty($a['user_progress'][$userId]['updated_on'])
                    && empty($b['user_progress'][$userId]['updated_on'])
                ) {
                    return -1;
                }

                if (!empty($b['user_progress'][$userId]['updated_on'])
                    && empty($a['user_progress'][$userId]['updated_on'])
                ) {
                    return 1;
                }

                return 0;
            }
        );
    }
}
