<?php

namespace App\Modules\RailTracker\Console\Commands;

use Illuminate\Console\Command;
use App\Modules\RailTracker\Services\BatchService;

class PrintKeyCount extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'PrintKeyCount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'PrintKeyCount';

    /**
     * @var BatchService
     */
    private $batchService;

    public function __construct(
        BatchService $batchService
    )
    {
        parent::__construct();

        $this->batchService = $batchService;
    }

    public function handle()
    {
        $requestKeys = $this->batchService->connection()->keys($this->batchService->batchKeyPrefix . 'request*');

        $this->info(count($requestKeys) . ' request-response-pairs retrieved.');
    }
}
