<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateExistingAccessCodesWithRolandSource extends Command
{
    protected $signature = 'UpdateExistingAccessCodesWithRolandSource';

    protected $description = 'Fill in the source attribute for the given musora ids from csv with roland-piano-promo value';

    public function handle()
    {
        $this->info('###### Starting UpdateExistingAccessCodesWithRolandSource command....  ######');

        $sourceValue = 'roland-piano-promo';

        $csv = array_map(
            function ($v) {return str_getcsv($v, ",");},
            file(base_path('musora_ids_old_roland_access_codes.csv'))
        );

        foreach ($csv as $row) {
            if (is_numeric($row[0])) {
                $rolandClaimerIds[] = $row[0];
            }
        }

        DB::connection(config('railcontent.database_connection_name'))
            ->table('ecommerce_access_codes')
            ->whereIn('claimer_id', $rolandClaimerIds)
            ->update(['source' => $sourceValue])
        ;

        $this->info('###### Command UpdateExistingAccessCodesWithRolandSource has finished ######');
    }
}
