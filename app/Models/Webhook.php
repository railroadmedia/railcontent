<?php

namespace App\Models;

use App\Modules\HelpScout\Console\Commands\WebHooks;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\Events\JobProcessed;


/**
 * App\Models\Webhook
 *
 * @property int $id
 * @property string $source
 * @property string $source_id
 * @property array $contents
 * @property array $job_details
 * @method static \Illuminate\Database\Eloquent\Builder|Webhook whereId($value)
 *
 * @mixin \Eloquent
 */
class Webhook extends Model
{
    protected $guarded = [
        'id'
    ];

    protected  $casts = [
        'job_details' => 'array',
        'contents' => 'array',
    ];

    /**
     * @return bool - flag to indicate if self + children jobs have been processed, or if the job crashed during construction for any reason
     */
    public function allComplete() : bool
    {
        //unset case
        if(!$this->job_details) {
            return false;
        }
        //previously set case
        foreach($this->job_details as $job) {
            if (!$job) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $job - Job to add to the jobDetails array
     * @return mixed - return updated $job object
     */
    public function syncJobAndWebhook($job) : mixed
    {
        $shortName = class_basename($job);
        $job->webhookJobInfo = ['parent_id' => $this->id, 'name' => $shortName];
        $this->setAndSaveJobDetails($shortName, false);
        return $job;
    }

    /**
     * Process any WebhookJob or WebhookChildJob objects to update the Webhook.job_detail
     * @param JobProcessed $event
     * @return void
     */
    public static function updateJobDetailsIfWebhookJob(JobProcessed $event) : void
    {
        $job = unserialize($event->job->payload()['data']['command']);
        $webhookInfo = $job->webhookJobInfo ?? null;
        if (!$webhookInfo) {
            return;
        }
        $parent = WebHook::whereId($webhookInfo['parent_id'])->first();
        if($parent) {
            $parent->setAndSaveJobDetails($webhookInfo['name'], true);
        }
    }

    /**
     * Update job_details array value and save to database
     * This has an unfortunate race condition built in that I (Adrian) didn't know how to get around. Locks don't work like I'm used to
     * @param string $name - name of Job
     * @param bool $set - value to set job_details entry to
     * @return void
     */
    private function setAndSaveJobDetails(string $name, bool $set) : void
    {
        $model = Webhook::lockForUpdate()->find($this->id);
        $jobDetails = $model->job_details;
        $jobDetails[$name] = $set;
        $model->job_details = $jobDetails;
        $model->save();
    }
}
