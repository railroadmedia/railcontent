<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Webhook;
use Illuminate\Support\Facades\Log;

/**
 * Utility class implementing ShouldQueue used for receiving, saving, and tracking incoming webhooks from external services.
 * This class stores webhook and children Job information in the Webhook table.
 */
class WebhookJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected Webhook $webhook;
    protected array $children;
    protected string $queueName;
    public array $webhookJobInfo;
    protected bool $alreadyRun = false;

    /**
     * @param string $source - name of webhook source (eg: shopify-order-created)
     * @param string $source_id - unique identifier for the webhook
     * @param array $contents - request->all(), or other array of data to save
     * @param array $children - children jobs. Jobs must be of derived type WebhookChildJob, or have the serializable property webhookJobInfo as part of the class
     * @param array $delays - same length array as children for time to delay each child job.Leaving this null will dispatch children without delay
     * @param string $queue - name of the queue to dispatch children jobs on
     */
    public function __construct(string $source, string $source_id, array $contents, array $children, array $delays = [], string $queue = '')
    {
        $this->queueName = $queue;
        $this->webhook = Webhook::firstOrCreate([
                        'source' => $source,
                        'source_id' => $source_id], [
                        'contents' => $contents]);
        if (!$this->webhook->wasRecentlyCreated) {
            Log::info("Duplicated webhook id:" . $this->webhook->source_id . " from: "  . $this->webhook->source);
            if (!$this->webhook->allComplete()) {
                Log::info("Previous webhook was already finished. Running duplicate warning. webhook id:" . $this->webhook->source_id . " from: "  . $this->webhook->source);
                $this->alreadyRun = true;
            }
        }
        if (!$this->alreadyRun) {
            $this->children = $this->buildChildren($children, $delays);
            $this->webhook->setWebhookJobInfo($this);
        }
    }


    /**
     * ShouldQueue implementation of handle()
     * Dispatches all children jobs or default or provided queue
     * @return void
     */
    public function handle()
    {
        if ($this->alreadyRun) {
            return;
        }

        $allJobs = [$this];
        foreach($this->children as $child) {
            $allJobs[] = $child['job'];
        }
        $this->webhook->initializeJobDetails($allJobs);
        foreach($this->children as $child) {
            $delay = $child['delay'] ?? 0;
            $job = $child['job'];
            $dispatch = $delay ? dispatchWithDelay($job, $delay) : dispatch($job);
            if ($this->queueName) {
                $dispatch->onQueue($this->queueName);
            }
        }
    }

    /**
     * @param array<WebhookChildJob> $children - job must be of WebChildJob or implement the $webhookJobInfo parameter for serialization
     * @param array<int>|null $delays - number of seconds to delay the corresponding child job
     * @return array - internal array of children jobs + metadata
     */
    private function buildChildren(array $children, array $delays = []): array
    {
        $childrenWithDelays = [];

        $length = count($children);
        if ($delays && $length != count($delays)) {
            throw new \InvalidArgumentException("Children and delays must be of equal length");
        }
        while($children) {
            $job = array_shift($children);
            if(!property_exists($job, 'webhookJobInfo')) {
                $name = get_class($job);
                throw new \InvalidArgumentException("$name must have the 'webhookJobInfo' property or derive from 'WebhookChildJob");
            }
            $delay = $delays ? array_shift($delays) : 0;
            $childrenWithDelays[] = [
                'job' => $job,
                'delay' => $delay
            ];
        }

        return $childrenWithDelays;
    }

    /**
     * @return int - number of children jobs
     */
    public function countChildren()
    {
        return count($this->children);
    }
}
