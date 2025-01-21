<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;

class IsDrumeoLifetimeUserFieldResyncTool extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'IsDrumeoLifetimeUserFieldResyncTool';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'IsDrumeoLifetimeUserFieldResyncTool';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'IsDrumeoLifetimeUserFieldResyncTool';

    /**
     * Execute the console command.
     */
    public function handle(
        DatabaseManager $databaseManager
    ): int {
        $databaseManager->connection(config('ecommerce.database_connection_name'))
            ->disableQueryLog();

        $databaseManager->connection(config('railcontent.database_connection_name'))
            ->disableQueryLog();

        $query =
            $databaseManager->connection(config('ecommerce.database_connection_name'))
                ->table('ecommerce_user_products')
                ->selectRaw('ecommerce_user_products.user_id as user_id')
                ->where('ecommerce_user_products.product_id', '=', 141)
                ->whereNull('ecommerce_user_products.deleted_at')
                ->whereNull('ecommerce_user_products.expiration_date')
                ->groupBy('user_id')
                ->orderBy('user_id', 'asc');

        $count = 0;
        $query->chunk(500, function (Collection $rows) use ($databaseManager, &$count) {
            $userIdsToSync = [];

            foreach ($rows as $userProduct) {
                $userIdsToSync[] = $userProduct->user_id;
            }

            $databaseManager->connection(config('ecommerce.database_connection_name'))
                ->table('usora_users')
                ->whereIn('id', $userIdsToSync)
                ->update(
                    [
                        'is_drumeo_lifetime_member' => true,
                    ]
                );

            $count = $count + count($userIdsToSync);

            $this->info('Sync Drumeo lifetime users : '.$count);
        });



        return true;
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [];
    }
}
