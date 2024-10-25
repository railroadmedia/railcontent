<?php

namespace Modules\Content\Services;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\EventDataSynchronizer\Services\CustomerIoSyncService;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Modules\UserManagementSystem\Models\User;

class PlaylistsService
{
    public function processFilterOptions($filterOptions, $availableCategories = [])
    {
        $filterOptionsArray = ['categories' => []];

        // Build the filterOptions array from the results
        foreach ($filterOptions as $result) {
            $filterOptionsArray['categories'][] = $result->category . ' (' . $result->playlistsCount . ')';
        }

        return $filterOptionsArray;
    }
}
