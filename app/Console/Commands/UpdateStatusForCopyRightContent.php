<?php

namespace App\Console\Commands;

use App\Console\Commands\Infrastructure\ContentoToUpdateStatus;
use App\Jobs\DelistContentJob;
use Illuminate\Console\Command;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class UpdateStatusForCopyRightContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateStatusForCopyRightContent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'UpdateStatusForCopyRightContent';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        ContentRepository::$bypassPermissions = true;
        ContentRepository::$pullFutureContent = true;
        $this->info("Starting UpdateStatusForCopyRightContent job");
        $count = 0;
        $chunkSize = 500;
        $contentChunk = array_chunk(ContentoToUpdateStatus::DELIST, $chunkSize);
        foreach($contentChunk as $chunk) {
            $count += count($chunk);
            dispatch(new DelistContentJob($chunk, ContentService::STATUS_UNLISTED));
            $this->info("Dispatched UpdateStatusForCopyRightContent to delist Count: $count");
        }
        $contentChunk = array_chunk(ContentoToUpdateStatus::DRAFT, $chunkSize);
        foreach($contentChunk as $chunk) {
            $count += count($chunk);
            dispatch(new DelistContentJob($chunk, ContentService::STATUS_DRAFT));
            $this->info("Dispatched UpdateStatusForCopyRightContent to draft Count: $count");
        }
        return 0;
    }
}
