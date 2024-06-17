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

        $brands = ['drumeo', 'pianote', 'guitareo', 'singeo'];

        $basicMembershipPermissionIds = [1, 52, 73, 77, 91, 78, 88, 89, 90];
        $plusMembershipPermissionIds = [92];
        $lifetimeMembershipPermissionIds = [78, 88, 89, 90];

        $allMembershipPermissionIds = array_merge(
            $basicMembershipPermissionIds,
            $plusMembershipPermissionIds,
            $lifetimeMembershipPermissionIds
        );

        while ($dateIncrement <= $endDate) {
            $this->info('Processing daily stats for date: ' . $dateIncrement->toDateTimeString());
            $dateIncrementEndOfDay = $dateIncrement->copy()->endOfDay();

//            $table->date('day')->index();
//            $table->enum('brand_allocation_type', ['by_last_used_brand', 'by_most_content_starts', 'by_percentage_of_content_starts'])->index();
//            $table->enum('brand', ['drumeo','pianote','guitareo','singeo','musora'])->index();
//            $table->integer('total_members_with_full_access')->index();
//            $table->integer('total_members_with_basic_access')->index();
//            $table->integer('total_lifetime_members')->index();
//            $table->integer('total_monthly_members')->index();
//            $table->integer('total_annual_members')->index();
//            $table->integer('total_members_in_trial_period')->index();
//            $table->integer('total_active_members')->index();
//            $table->integer('total_expired_members')->index();
//            $table->integer('total_members')->index();
//            $table->dateTime('generated_at')->index();

            // access by last used brand
            $totalPlusMembersPerBrand = [
                'drumeo' => 0,
                'pianote' => 0,
                'guitareo' => 0,
                'singeo' => 0
            ];
            $totalBasicMembersPerBrand = $totalPlusMembersPerBrand;
            $totalMonthlyMembersPerBrand = $totalPlusMembersPerBrand;
            $totalAnnualMembersPerBrand = $totalPlusMembersPerBrand;
            $totalMembersInTrialPeriodPerBrand = $totalPlusMembersPerBrand;
            $totalLifetimeMembersPerBrand = $totalPlusMembersPerBrand;
            $totalMembersPerBrand = $totalPlusMembersPerBrand;

            $allUserPermissionsOfDay = UserAccessPermission::query()
                ->select(
                    [
                        'user_id',
                        'last_used_brand',
                        'time_days',
                        'time_months',
                        'trial_expiration_date',
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
//                ->where(function ($query) use ($dateIncrement) {
//                    $query->where('trial_expiration_date', '<', $dateIncrement)
//                        ->orWhereNull('trial_expiration_date');
//                })
                ->where('status', 'active')
//                ->where('user_id', 596143)
                ->groupBy('user_id', 'time_days', 'time_months', 'trial_expiration_date');

            $userIds = DB::connection()->select(
                "
            SELECT * FROM ((SELECT DISTINCT(user_id) as user_id, DATE_FORMAT(created_on,'%Y-%m-%d') as e_date FROM musora_laravel.railcontent_comments WHERE created_on >= '$dateIncrement' AND created_on <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(user_id) as user_id, DATE_FORMAT(created_on,'%Y-%m-%d') as e_date FROM musora_laravel.railcontent_comment_likes WHERE created_on >= '$dateIncrement' AND created_on <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(user_id) as user_id, DATE_FORMAT(created_on,'%Y-%m-%d') as e_date FROM musora_laravel.railcontent_content_likes WHERE created_on >= '$dateIncrement' AND created_on <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(user_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM musora_laravel.railcontent_playlist_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(railcontent_user_playlists.user_id) as user_id, DATE_FORMAT(railcontent_user_playlist_content.created_at,'%Y-%m-%d') as e_date
FROM musora_laravel.railcontent_user_playlist_content
LEFT JOIN musora_laravel.railcontent_user_playlists ON railcontent_user_playlists.id = railcontent_user_playlist_content.user_playlist_id
WHERE railcontent_user_playlist_content.created_at >= '$dateIncrement' AND railcontent_user_playlist_content.created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(author_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM drumeo_laravel.forum_posts WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(author_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM drumeo_laravel.forum_threads WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(liker_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM drumeo_laravel.forum_post_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(author_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM pianote_laravel.forum_posts WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(author_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM pianote_laravel.forum_threads WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(liker_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM pianote_laravel.forum_post_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(author_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM guitareo_laravel.forum_posts WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(author_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM guitareo_laravel.forum_threads WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(liker_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM guitareo_laravel.forum_post_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(author_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM singeo_laravel.forum_posts WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(author_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM singeo_laravel.forum_threads WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(liker_id) as user_id, DATE_FORMAT(created_at,'%Y-%m-%d') as e_date FROM singeo_laravel.forum_post_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(user_id) as user_id, DATE_FORMAT(updated_on,'%Y-%m-%d') as e_date FROM musora_laravel.railcontent_user_content_progress WHERE updated_on >= '$dateIncrement' AND updated_on <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
UNION (SELECT DISTINCT(user_id) as user_id, DATE_FORMAT(started_on,'%Y-%m-%d') as e_date FROM musora_laravel.railcontent_user_content_progress WHERE started_on >= '$dateIncrement' AND started_on <= '$dateIncrementEndOfDay' GROUP BY user_id, e_date)
) as user_e_days
GROUP BY user_id, e_date
ORDER BY e_date ASC
            "
            );

            $totalActiveUsers = count($userIds);
            $this->info("totalActiveUsers: " . $totalActiveUsers);

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

                if ($userPermission['time_months'] == 1) {
                    $totalMonthlyMembersPerBrand[$allocatedBrand] += 1;
                }
                if ($userPermission['time_months'] == 12) {
                    $totalAnnualMembersPerBrand[$allocatedBrand] += 1;
                }

                if (!empty($userPermission['trial_expiration_date'])) {
                    $trialExpirationDate = Carbon::parse($userPermission['trial_expiration_date']);

                    // if they are in their trial period
                    if ($trialExpirationDate > $dateIncrement && $userPermission['time_days'] > 0) {
                        $totalMembersInTrialPeriodPerBrand[$allocatedBrand] += 1;
                    }
                }
            }

            $totalMembers = 0;

            foreach ($brands as $brand) {
                $this->info('$totalPlusMembersPerBrand: ' . $brand . ' - ' . ($totalPlusMembersPerBrand[$brand] ?? 0));
                $this->info(
                    '$totalBasicMembersPerBrand: ' . $brand . ' - ' . ($totalBasicMembersPerBrand[$brand] ?? 0)
                );
                $this->info(
                    '$totalLifetimeMembersPerBrand: ' . $brand . ' - ' . ($totalLifetimeMembersPerBrand[$brand] ?? 0)
                );
                $this->info(
                    '$totalMonthlyMembersPerBrand: ' . $brand . ' - ' . ($totalMonthlyMembersPerBrand[$brand] ?? 0)
                );
                $this->info(
                    '$totalAnnualMembersPerBrand: ' . $brand . ' - ' . ($totalAnnualMembersPerBrand[$brand] ?? 0)
                );
                $this->info(
                    '$totalMembersInTrialPeriodPerBrand: ' . $brand . ' - ' . ($totalMembersInTrialPeriodPerBrand[$brand] ?? 0)
                );

                $totalMembersPerBrand[$brand] += $totalPlusMembersPerBrand[$brand] ?? 0;
                $totalMembersPerBrand[$brand] += $totalBasicMembersPerBrand[$brand] ?? 0;
                $totalMembersPerBrand[$brand] += $totalLifetimeMembersPerBrand[$brand] ?? 0;

                $this->info('$totalMembersPerBrand: ' . $brand . ' - ' . ($totalMembersPerBrand[$brand] ?? 0));

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
