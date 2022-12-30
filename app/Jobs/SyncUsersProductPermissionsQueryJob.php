<?php

namespace App\Jobs;

use App\Modules\EventDataSynchronizer\Listeners\UserProductToUserContentPermissionListener;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class SyncUsersProductPermissionsQueryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    private array $userIdsToSync;

    /**
     * @param array $userIdsToSync
     */
    public function __construct(array $userIdsToSync)
    {
        $this->userIdsToSync = $userIdsToSync;
    }


    public function handle(UserProductToUserContentPermissionListener $userProductToUserContentPermissionListener)
    {
        Log::info(
            'SyncUsersProductPermissionsQueryJob ID: ' . $this->job->getJobId() .
            ' -- starting sync for ' . count($this->userIdsToSync) .
            ' users -- ' . implode(',', $this->userIdsToSync)
        );

        foreach ($this->userIdsToSync as $userId) {
            $userProductToUserContentPermissionListener->syncUserId($userId);
            User::query()->findOrFail($userId)->update(['membership_level' => 'plus']);
        }

        Log::info(
            'Finished SyncUsersProductPermissionsQueryJob ID: ' . $this->job->getJobId() .
            ' -- for count ' . count($this->userIdsToSync)
        );
    }
}
