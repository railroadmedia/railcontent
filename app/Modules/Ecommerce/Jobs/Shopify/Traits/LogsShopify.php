<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use Illuminate\Support\Facades\Log;

trait LogsShopify
{

    /**
     * Log the given info message
     *
     * @param string $infoMessage
     * @return void
     */
    protected function logInfo(string $infoMessage): void
    {
        Log::info($infoMessage);
    }

    /**
     * Log the given debug message
     *
     * @param string $debugMessage
     * @return void
     */
    protected function logDebug(string $debugMessage): void
    {
        Log::debug($debugMessage);
    }

    /**
     * Log the given error message
     *
     * @param string $errorMessage
     * @return void
     */
    protected function logError(string $errorMessage): void
    {
        Log::error($errorMessage);
    }

    /**
     * Get the name of the class that called this job - useful for logging
     *
     * @return string
     */
    abstract protected function getClassName(): string;
}
