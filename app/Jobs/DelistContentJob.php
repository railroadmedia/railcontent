<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\RailcontentV2DataSyncingService;
use Throwable;

class DelistContentJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;


    /**
     * @param array $contentIdsToDelist
     */
    public function __construct(private array $contentIdsToDelist, private string $status)
    {
    }


    public function handle(ContentService $contentService, RailcontentV2DataSyncingService $dataSyncingService)
    {
        ContentRepository::$bypassPermissions = true;
        ContentRepository::$pullFutureContent = true;
        $count = count($this->contentIdsToDelist);
        $idMin = $this->contentIdsToDelist[0];
        $idMax = $this->contentIdsToDelist[$count - 1];
        Log::info(
            'Starting DelistContentJob ID: ' . $this->job->getJobId() .
            ' -- starting sync for ' . count($this->contentIdsToDelist) .
            ' min -- ' . $idMin . ' max -- ' . $idMax
        );
        $dataToUpdate = ['status' => $this->status];
        $contentService->bulkUpdate($this->contentIdsToDelist, $dataToUpdate);
        $contentService->fillCompiledViewContentDataColumnForContentIds($this->contentIdsToDelist);
        Log::info(
            'Finished DelistContentJob ID: ' . $this->job->getJobId() .
            ' -- for count ' . count($this->contentIdsToDelist)
        );
    }

    /**
     * The job failed to process.
     *
     * @param Throwable $exception
     */
    public function failed(
        Throwable $exception
    ) {
        error_log($exception);

        $this->fail($exception);
    }
}
