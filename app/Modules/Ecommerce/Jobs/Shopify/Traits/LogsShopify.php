<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use Illuminate\Support\Facades\Log;

trait LogsShopify
{
    /**
     * Log the given info message
     */
    protected function logInfo(string $infoMessage): void
    {
        Log::info($infoMessage);
    }

    /**
     * Log the given debug message
     */
    protected function logDebug(string $debugMessage): void
    {
        Log::debug($debugMessage);
    }

    /**
     * Log the given warning message
     */
    protected function logWarning(string $warningMessage): void
    {
        Log::warning($warningMessage);
    }

    /**
     * Log the given error message
     */
    protected function logError(string $errorMessage): void
    {
        Log::error($errorMessage);
    }

    /**
     * Get the name of the class that called this job - useful for logging
     */
    abstract protected function getClassName(): string;
}
