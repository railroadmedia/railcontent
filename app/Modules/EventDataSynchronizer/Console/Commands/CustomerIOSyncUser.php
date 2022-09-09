<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;


use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncUserByUserId;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CustomerIOSyncUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customerio:syncuser {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync provided users customer io data';

    private $queueConnectionName = 'database';
    private $queueName = 'usorahelpscout';

    public function __construct(
    ) {
        parent::__construct();

        $this->queueConnectionName = config('event-data-synchronizer.usora_helpscout_queue_connection_name', 'database');
        $this->queueName = config('event-data-synchronizer.usora_helpscout_queue_name', 'usorahelpscout');
    }

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(UserService $userService)
    {
        var_dump(openssl_get_cert_locations()); die;
        $userId = $this->argument('user');
        $user = $userService->getByIdOrNull($userId);
        dispatch(
            (new CustomerIoSyncUserByUserId($user))->onConnection($this->queueConnectionName)
                ->onQueue($this->queueName)
                ->delay(
                    Carbon::now()
                        ->addSeconds(3)
                )
        );
    }
}
