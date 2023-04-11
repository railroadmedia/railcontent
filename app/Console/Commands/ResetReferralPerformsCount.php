<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetReferralPerformsCount extends Command
{

    protected $signature = 'ResetReferralPerformsCount';

    protected $description = 'Reset the referral count for all users';

    public function handle()
    {
        $this->info('###### Starting ResetReferralPerformsCount...  ######');

        DB::connection(config('railcontent.database_connection_name'))
            ->update('update referral_referrers set referrals_performed = 0');

        $this->info('###### Command ResetReferralPerformsCount has finished ###### ');

    }
}
