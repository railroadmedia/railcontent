<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use Illuminate\Support\Facades\Storage;

trait UsesStorageForShopifySyncData
{
    /**
     * Delete the given files from storage
     *
     * @param array $fileNames
     * @return void
     */
    protected function deleteFiles(array $fileNames): void
    {
        if (app()->environment("local", "development")) {
            foreach($fileNames as $fileName) {
                Storage::delete($fileName);
            }
        } else {
            foreach($fileNames as $fileName) {
                Storage::disk('musora_web_platform_s3')->delete($fileName);
            }
        }
    }

    /**
     * Get the file from storage, using the provided file name
     *
     * @param string $fileName
     * @return string|null
     */
    protected function getFile(string $fileName): ?string
    {
        if (app()->environment("local", "development")) {
            return Storage::get($fileName);
        } else {
            return Storage::disk('musora_web_platform_s3')->get($fileName);
        }
    }
}
