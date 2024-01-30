<?php

namespace App\Modules\EventDataSynchronizer\tests\Fixtures;

use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use App\Modules\EventDataSynchronizer\Providers\UserProviderInterface;

class TestingUserProvider implements UserProviderInterface
{
    private DatabaseManager $databaseManager;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function isAdministrator(int $userId): bool
    {
        return $this->databaseManager->connection(config('event-data-synchronizer.users_database_connection_name'))
            ->table('usora_users')
            ->where('id', $userId)
            ->where('permission_level', 'administrator')
            ->exists();
    }

    public function saveExperiencePoints(int $userId, array $totalXp, $shouldRevert = false): bool
    {
        // TODO: Implement saveExperiencePoints() method.
    }
}
