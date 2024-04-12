<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\ShopifySyncCustomerByEmailJob;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ShopifySyncCustomerByEmailInS3File extends Command
{
    protected $signature = 'ecommerce:shopify-sync-customer-by-email-in-s3-file
                            {fileName : The name of the file in S3 storage that contains the email addresses. This expects one address per line, with no header.}';

    public function handle()
    {
        $startAt = Carbon::now();
        $fileName = $this->argument('fileName');

        if (Storage::disk('musora_web_platform_s3')->missing($fileName)) {
            $this->error("$fileName not found");
            return self::FAILURE;
        }

        $stream = Storage::disk('musora_web_platform_s3')->readStream($fileName);

        if (!$stream) {
            $this->error("Failed to open stream for reading $fileName");
            return self::FAILURE;
        }

        $emails = collect();
        while (($line = fgets($stream)) !== false) {
            $emails->push($line);
        }
        if (!feof($stream)) {
            $this->error("unexpected fgets() failure");
        }
        fclose($stream);

        $this->info("ShopifySyncCustomerByEmailInFile: read in {$emails->count()} emails. Pushing jobs to the queue.");

        $jobs = collect();
        $emails->chunk(100)->each(function ($chunk) use ($jobs) {
            $jobs->push(new ShopifySyncCustomerByEmailJob($chunk->toArray()));
        });

        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(
                    sprintf("ShopifySyncCustomerByEmailInFile: completed in %s", $startAt->diff()->format('%h hours %I minutes, %S seconds'))
                );
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();

        $this->info(
            sprintf(
                "ShopifySyncCustomerByEmailInFile: Batch ID %s dispatched.",
                $batch->id
            )
        );

        return self::SUCCESS;
    }
}
