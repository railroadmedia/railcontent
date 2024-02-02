<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\EventDataSynchronizer\Services\HelpScoutSyncService;
use App\Modules\HelpScout\Services\HelpScoutService;
use Carbon\Carbon;
use Exception;
use HelpScout\Api\Exception\ConflictException;
use HelpScout\Api\Exception\RateLimitExceededException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;

class SynchUsoraHelpscout implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var User
     */
    private $userId;

    const DELAY_SECONDS = 600;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param  DatabaseManager $databaseManager
     * @param  HelpScoutSyncService $helpScoutSyncService
     * @param  HelpScoutService $helpScoutService
     *
     * @throws \Throwable
     */
    public function handle(
        DatabaseManager $databaseManager,
        HelpScoutSyncService $helpScoutSyncService,
        HelpScoutService $helpScoutService
    ) {
        $usoraConnection = $databaseManager->connection(config('usora.database_connection_name'));
        $railhelpscoutConnection = $databaseManager->connection(config('railhelpscout.database_connection_name'));

        $processed = 0;

        echo 'starting processing users, starting id >= ' . $this->userId . "\n";

        $usoraConnection->table('usora_users')
            ->orderBy('id', 'asc')
            ->where('id', '>=', $this->userId)
            ->chunk(
                25,
                function (Collection $userRows) use (
                    $helpScoutSyncService,
                    $railhelpscoutConnection,
                    $helpScoutService
                ) {

                    $existingCustomersMap =
                        $railhelpscoutConnection->table('helpscout_customers')
                            ->whereIn(
                                'internal_id',
                                $userRows->pluck('id')
                                    ->toArray()
                            )
                            ->get()
                            ->pluck('internal_id')
                            ->mapWithKeys(function ($item) {
                                return [$item => true];
                            })
                            ->toArray();

                    $result = null;

                    foreach ($userRows as $userData) {

                        if (!isset($existingCustomersMap[$userData->id])) {

                            $userAttributes =
                                $helpScoutSyncService->getUsersAttributesById(
                                    $userData->id,
                                    $userData->first_name,
                                    $userData->display_name,
                                    $userData->country,
                                    $userData->city,
                                    $userData->phone_number,
                                    $userData->timezone
                                );

                            try {
                                $helpScoutService->createCustomer(
                                    $userData->id,
                                    $userData->first_name,
                                    $userData->last_name,
                                    $userData->email,
                                    $userAttributes
                                );

                                echo 'Sync successful for user id ' . $userData->id . ', email ' . $userData->email . "\n";

                            } catch (RateLimitExceededException $rateException) {

                                dispatch(
                                    (new SynchUsoraHelpscout($userData->id))
                                        ->delay(Carbon::now()->addSeconds(self::DELAY_SECONDS))
                                );

                                echo 'Dispatched delayed sync to start with user id ' . $userData->id . ', email ' . $userData->email . "\n";

                                $result = false; // stop processing further chunks
                                break; // stop processing current chunk

                            } catch (ConflictException $conflictException) {

                                echo 'ConflictException raised, user with usora id: ' . $userData->id . ' and email: ' . $userData->email
                                    . " already has a helpscout customer entry\n";

                            } catch (Exception $ex) {

                                echo 'Exception while trying to sync user id ' . $userData->id . ', email ' . $userData->email . "\n";
                                print_r($ex);
                            }
                        }
                    }

                    return $result;
                }
            );
    }
}
