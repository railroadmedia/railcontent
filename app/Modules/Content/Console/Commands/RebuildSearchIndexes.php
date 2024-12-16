<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Services\SearchService;

class RebuildSearchIndexes extends Command
{
    protected $signature = 'content:rebuildSearchIndexes';
    protected $description = 'Rebuilds search indexes';

    public function handle(SearchService $searchService): void
    {
        $this->withExecutionTime(function () use ($searchService) {
            $searchService->rebuildIndexes();
        });
    }
}
