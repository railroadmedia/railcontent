<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateAccessCodesProductId extends Command
{
    protected $name  = 'UpdateAccessCodesProductId';

    protected $signature = 'UpdateAccessCodesProductId';

    protected $description = 'Update the product ids of given access codes 124 to 420;
    https://musoraproduct.myjetbrains.com/youtrack/issue/MT-431/Test-TDT-BBDB-Redemption-Pages-Codes';

    public function handle(): void
    {
        $this->info('###### Starting UpdateAccessCodesProductId command....  ######');

        $csv = array_map(
            function ($v) {return str_getcsv($v, ",");},
            file(base_path('access-codes-to-be-updates-MT-431.csv'))
        );

        foreach ($csv as $row) {
            $accessCodes[] = $row[0];
        }

        $accessCodes = array_chunk($accessCodes, 1000);

        foreach ($accessCodes as $accessCodesChunk) {
            $accessCodesChunk = array_map(function ($code) {
                return "'" . $code . "'";
            }, $accessCodesChunk);

            $accessCodesChunk = implode(',', $accessCodesChunk);

            $sql = "UPDATE ecommerce_access_codes SET product_ids = 'a:1:{i:0;i:420;}' WHERE code IN (" . $accessCodesChunk . ")";

            \DB::connection(config('railcontent.database_connection_name'))
                ->statement($sql);
        }

        $this->info('###### Command UpdateAccessCodesProductId has finished ######');
    }

}
