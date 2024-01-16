<?php

namespace App\Listeners\Content;

use App\Http\Middleware\LoggingContextMiddleware;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;

class LoggingEventListener
{
    public function commandStarting(CommandStarting $event): void
    {
        Log::shareContext(
            array_filter([
                    'tid' => LoggingContextMiddleware::getTraceId(),
                    'command' => $event->command,
                ]
            )
        );
    }

    public function jobProcessing(JobProcessing $event): void
    {
        $displayName = $event->job->payload()['displayName'] ??= 'unknown';
        Log::shareContext(
            array_filter([
                    'tid' => LoggingContextMiddleware::getTraceId(),
                    'job' => $displayName,
                ]
            )
        );
    }

}
