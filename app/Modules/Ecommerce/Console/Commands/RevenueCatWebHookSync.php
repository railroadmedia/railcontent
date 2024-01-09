<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Controllers\RevenueCatController;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class RevenueCatWebHookSync extends Command
{
    protected $signature = 'ecommerce:RevenueCatWebhookSync {fileName} {index=1} {limit=100}';

    public function handle(): void
    {
        $this->withExecutionTime(function () {
            $fileName = $this->argument('fileName');
            $content = Storage::disk('s3')->get($fileName);
            $data = explode("\n", $content);
            $index = intval($this->argument('index'));
            $limit = intval($this->argument('limit'));
            $end = $index + $limit;
            for ($i = $index; $i < $end; $i++) {
                $this->info("ecommerce:RevenueCatWebhookSync: Parsing line $i");
                try {
                    $test = explode("\",\"", $data[$i])[2];
                    $test2 = explode(",200,", $test)[0];
                    $event = substr($test2, 0, -1);
                    $event = str_replace("\"\"", "\"", $event);
                    $decodedEvent = json_decode($event, true);

                    $request = Request::create('/ecommerce/revenuecat/webhook/notification', 'POST', $decodedEvent);
                    $response = app()->handle($request);
                    $this->info(print_r($event, true));
                }
                catch (\Throwable $e) {
                    $this->info("ecommerce:RevenueCatWebhookSync: Error parsing line $i");
                    $this->info($e->getMessage());
                }
            }
        });
    }
}
