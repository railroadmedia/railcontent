<?php

namespace App\Console\Commands;

use App\Modules\Ecommerce\Models\UserAccessPermission;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class GenerateDailyStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:dailystats {startDate?} {endDate?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates daily stats rows for all days between passed in dates including the start and end day.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $startDate = $this->argument('startDate');
        $endDate = $this->argument('endDate');
        $startDate = !empty($startDate) ? Carbon::parse($startDate)->startOfDay() : Carbon::now()->startOfDay();
        $endDate = !empty($endDate) ? Carbon::parse($endDate)->startOfDay() : Carbon::now()->startOfDay();

        $dateIncrement = $startDate->clone();

        $brands = ['drumeo', 'pianote', 'guitareo', 'singeo', 'musora'];

        $basicMembershipPermissionIds = [1, 52, 73, 77, 91, 78, 88, 89, 90];
        $plusMembershipPermissionIds = [92];
        $lifetimeMembershipPermissionIds = [78, 88, 89, 90];

        $allMembershipPermissionIds = array_merge(
            $basicMembershipPermissionIds,
            $plusMembershipPermissionIds,
            $lifetimeMembershipPermissionIds
        );

        while ($dateIncrement <= $endDate) {
            $this->info('Processing daily stats for date: ' . $dateIncrement->toDateString());

//            $table->date('day')->index();
//            $table->enum('brand_allocation_type', ['by_last_used_brand', 'by_most_content_starts', 'by_percentage_of_content_starts'])->index();
//            $table->enum('brand', ['drumeo','pianote','guitareo','singeo','musora'])->index();
//            $table->integer('total_members_with_full_access')->index();
//            $table->integer('total_members_with_basic_access')->index();
//            $table->integer('total_lifetime_members')->index();
//            $table->integer('total_active_members')->index();
//            $table->integer('total_expired_members')->index();
//            $table->dateTime('generated_at')->index();

            // access by last used brand
            $totalMembers = 0;

            $totalPlusMembersPerBrand = [
                'drumeo' => 0,
                'pianote' => 0,
                'guitareo' => 0,
                'singeo' => 0
            ];
            $totalBasicMembersPerBrand = $totalPlusMembersPerBrand;
            $totalLifetimeMembersPerBrand = $totalPlusMembersPerBrand;

            $allUserPermissionsOfDay = UserAccessPermission::query()
                ->select(
                    [
                        'user_id',
                        'last_used_brand',
                        DB::raw('GROUP_CONCAT(DISTINCT brand) as brands'),
                        DB::raw('GROUP_CONCAT(DISTINCT name) as permissions')
                    ]
                )
                ->join(
                    'railcontent_permissions',
                    function (JoinClause $join) use ($allMembershipPermissionIds) {
                        $join->on(
                            'railcontent_permissions.id',
                            '=',
                            'user_access_permissions.permission_id'
                        )
                            ->whereIn('permission_id', $allMembershipPermissionIds);
                    }
                )
                ->join('usora_users', 'user_access_permissions.user_id', '=', 'usora_users.id')
                ->whereRaw("'$dateIncrement' >= start_time")
                ->whereRaw("'$dateIncrement' <= end_time")
                ->where(function ($query) use ($dateIncrement) {
                    $query->where('trial_expiration_date', '<', $dateIncrement)
                        ->orWhereNull('trial_expiration_date');
                })
                ->where('status', 'active')
                ->where('user_id', 596143)
                ->groupBy('user_id');

            $allUserPermissionsOfDay = $allUserPermissionsOfDay->get()->toArray();

            foreach ($allUserPermissionsOfDay as $userPermission) {
                if (in_array($userPermission['last_used_brand'], $brands)) {
                    $allocatedBrand = $userPermission['last_used_brand'];
                }

                if (empty($allocatedBrand)) {
                    $allocatedBrand = 'musora';
                }

                if (str_contains(strtolower($userPermission['permissions']), 'lifetime')) {
                    $totalLifetimeMembersPerBrand[$allocatedBrand] += 1;
                    continue;
                }

                if (str_contains(strtolower($userPermission['permissions']), 'plus')) {
                    $totalPlusMembersPerBrand[$allocatedBrand] += 1;
                } else {
                    $totalBasicMembersPerBrand[$allocatedBrand] += 1;
                }
            }

            dd(2);

            $totalMembers = 0;

            foreach ($brands as $brand) {
                $this->info('$totalPlusMembersPerBrand: ' . $brand . ' - ' . ($totalPlusMembersPerBrand[$brand] ?? 0));
                $this->info('$totalBasicMembersPerBrand: ' . $brand . ' - ' . ($totalBasicMembersPerBrand[$brand] ?? 0));
                $this->info('$totalLifetimeMembersPerBrand: ' . $brand . ' - ' . ($totalLifetimeMembersPerBrand[$brand] ?? 0));

                $totalMembers += $totalPlusMembersPerBrand[$brand] ?? 0;
                $totalMembers += $totalBasicMembersPerBrand[$brand] ?? 0;
                $totalMembers += $totalLifetimeMembersPerBrand[$brand] ?? 0;
            }

            $this->info('$totalMembers: ' . $totalMembers);

            // active

            $dateIncrement = $dateIncrement->addDay();
        }

        return Command::SUCCESS;
    }
}
