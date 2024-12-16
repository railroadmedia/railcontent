<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Controllers\ContentMetadataController;
use Modules\UserManagementSystem\Models\User;

class VerifyUserContextPerformance extends Command
{
    protected $signature = 'VerifyUserContextPerformance';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        /** @var ContentMetadataController $controller */
        $controller = app()->make(ContentMetadataController::class);
        $data = [];
        User::query()->select(['id'])->orderBy('id')->chunk(1000, function ($users) use ($controller, &$data) {
            foreach ($users as $user) {
                $timeStart = microtime(true);

                $controller->getUserContextData($user);

                $diff = microtime(true) - $timeStart;
                $sec = intval($diff * 1000);
                if ($sec > 2000) {
                    //$this->info("User $user->id ($sec ms)");
                    $data[$user->id] = ['user' => $user->id, 'sec' => $sec];
                }
            }
            //$this->info("Processed $user->id");
        });
        $this->table(['user', 'sec'], $data);
    }
}
