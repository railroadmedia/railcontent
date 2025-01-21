<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateExistingAccessCodesWithThomannSource extends Command
{
    protected $signature = 'UpdateExistingAccessCodesWithThomannSource';

    protected $description = 'Fill in the source for the given csv batch with thomann-11-2022';

    public function handle(): void
    {
        $this->info('###### Starting UpdateExistingAccessCodesWithThomannSource comand....  ######');

        $sourceValue = 'thomann-11-2022';

        $csv = array_map(
            function ($v) {return str_getcsv($v, ",");},
            file(base_path('thomann-access-codes-2022-11-16.csv'))
        );

        foreach ($csv as $row) {
            $thomannAccessCodes[] = $row[0];
        }

        DB::connection(config('railcontent.database_connection_name'))
            ->table('ecommerce_access_codes')
            ->whereIn('code', $thomannAccessCodes)
            ->update(['source' => $sourceValue])
        ;

        $this->info('###### Command UpdateExistingAccessCodesWithThomannSource has finished ######');
    }

}
