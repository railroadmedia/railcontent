<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use App\Models\Webhook;

/**
 * Utility class used as part of the WebhookJob workflow.
 * This is an empty class implementing ShouldQueue that adds a $webhookJobInfo parameter to support the necessary data serialization into and out of the Queue
 */
class WebhookChildJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public array $webhookJobInfo;
}

