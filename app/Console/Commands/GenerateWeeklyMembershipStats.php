<?php

namespace App\Console\Commands;

use App\Models\WeeklyUserStatistic;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GenerateWeeklyMembershipStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:weekly_statistics {startDate?} {endDate?}';
    // r mwp artisan generate:weekly_statistics "2024-05-01" "2024-05-01"

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates weekly stats rows for all days between passed in dates including the start and end day.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Reporting is always Monday 00:00:00 -> Sunday 23:59:59

        $startDate = $this->argument('startDate');
        $endDate = $this->argument('endDate');

        // Default to generating the last 2 weeks of data
        $startDate = !empty($startDate) ? Carbon::parse($startDate)->startOfWeek(1) : Carbon::now()->startOfWeek(
            1
        )->subWeek();
        $endDate = !empty($endDate) ? Carbon::parse($endDate)->endOfWeek(1) : Carbon::now()->endOfWeek(1);

        $dateIncrement = $startDate->clone();

        $brands = ['drumeo', 'pianote', 'guitareo', 'singeo', 'musora', 'basseo'];

        $basicMembershipPermissionIds = [1, 52, 73, 77, 91, 78, 88, 89, 90];
        $plusMembershipPermissionIds = [92];
        $lifetimeMembershipPermissionIds = [78, 88, 89, 90];

        $allMembershipPermissionIds = array_merge(
            $basicMembershipPermissionIds,
            $plusMembershipPermissionIds,
            $lifetimeMembershipPermissionIds
        );

        while ($dateIncrement <= $endDate) {
            $dateIncrementEndOfWeek = $dateIncrement->copy()->endOfWeek();
            $this->info(
                'Processing weekly stats for date: ' . $dateIncrement->toDateTimeString(
                ) . ' - ' . $dateIncrementEndOfWeek->toDateTimeString()
            );

//            $table->date('week')->index();
//            $table->integer('user_id')->index();
//            $table->enum('last_used_brand', ['drumeo','pianote','guitareo','singeo','musora'])->index();
//            $table->enum('most_content_starts_brand', ['drumeo','pianote','guitareo','singeo','musora'])->index();
//            $table->integer('count_of_content_starts_drumeo')->index();
//            $table->integer('count_of_content_starts_pianote')->index();
//            $table->integer('count_of_content_starts_guitareo')->index();
//            $table->integer('count_of_content_starts_singeo')->index();
//            $table->integer('count_of_content_starts_basseo')->index();
//            $table->integer('count_of_content_starts_musora')->index();
//            $table->enum('access_type', ['plus', 'basic'])->index();
//            $table->enum('access_frequency', ['monthly', 'yearly', 'lifetime'])->index();
//            $table->boolean('in_trial_period')->index();
//            $table->boolean('active')->index();
//            $table->boolean('expired')->index();
//            $table->dateTime('generated_at')->index();

            $progress = 0;

            // clear the week first
            WeeklyUserStatistic::query()->where('week', $dateIncrement)->delete();

            // Get all users with permissions and get all their permissions
            UserAccessPermission::query()
                ->select(
                    [
                        'usora_users.id as user_id',
                        'trial_expiration_date',
                        'last_used_brand',
                        'membership_expiration_date',
                    ]
                )
                ->join('usora_users', 'user_access_permissions.user_id', '=', 'usora_users.id')
                ->whereIn('user_access_permissions.permission_id', $allMembershipPermissionIds)
                ->whereRaw("'$dateIncrement' >= start_time")
                ->whereRaw("'$dateIncrement' <= end_time")
//                ->where(function ($query) use ($dateIncrementEndOfWeek, $dateIncrement) {
//                    $query->where('membership_expiration_date', '>', $dateIncrement);
//                    $query->where('membership_expiration_date', '<', $dateIncrementEndOfWeek);
//                })
//                ->where(function ($query) use ($dateIncrement) {
//                    $query->where('trial_expiration_date', '<', $dateIncrement)
//                        ->orWhereNull('trial_expiration_date');
//                })
                ->orderBy('usora_users.id', 'desc')
                ->groupBy('user_id')
                ->chunk(
                    10000,
                    function (Collection $userRows) use (
                        $allMembershipPermissionIds,
                        $brands,
                        &$progress,
                        $dateIncrement,
                        $dateIncrementEndOfWeek
                    ) {
                        $weeklyMembershipStatsRows = [];
                        $allUserIdsInChunk = $userRows->pluck('user_id')->unique();

                        // user access permissions rows
                        $usersAccessPermissionsRowsGroupedByUserId = DB::connection('musora_laravel_mysql')
                            ->table('user_access_permissions')
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
                            ->whereRaw("'$dateIncrement' >= start_time")
                            ->whereRaw("'$dateIncrement' <= end_time")
                            ->whereIn('user_access_permissions.permission_id', $allMembershipPermissionIds)
                            ->whereIn(
                                'user_access_permissions.user_id',
                                $allUserIdsInChunk
                            )
                            ->orderBy('user_id', 'desc')
                            ->get()
                            ->groupBy('user_id');

                        // user progress rows
                        $usersProgressRowsGroupedByUserId = DB::connection('musora_laravel_mysql')
                            ->table('railcontent_user_content_progress')
                            ->join(
                                'railcontent_content',
                                'railcontent_content.id',
                                '=',
                                'railcontent_user_content_progress.content_id'
                            )
                            ->select(
                                [
                                    'railcontent_user_content_progress.user_id',
                                    'brand',
                                    DB::raw('COUNT(railcontent_user_content_progress.id) as count')
                                ]
                            )
                            ->whereIn(
                                'railcontent_user_content_progress.user_id',
                                $allUserIdsInChunk
                            )
                            ->whereIn('railcontent_content.brand', $brands)
                            ->where(function (Builder $builder) use ($dateIncrement, $dateIncrementEndOfWeek) {
                                $builder->where(
                                    function (Builder $builder) use ($dateIncrementEndOfWeek, $dateIncrement) {
                                        $builder->whereRaw("started_on >= '$dateIncrement'")
                                            ->whereRaw("started_on <= '$dateIncrementEndOfWeek'");
                                    }
                                )->orWhere(function (Builder $builder) use ($dateIncrementEndOfWeek, $dateIncrement) {
                                    $builder->whereRaw("completed_on >= '$dateIncrement'")
                                        ->whereRaw("completed_on <= '$dateIncrementEndOfWeek'");
                                })->orWhere(function (Builder $builder) use ($dateIncrementEndOfWeek, $dateIncrement) {
                                    $builder->whereRaw("updated_on >= '$dateIncrement'")
                                        ->whereRaw("updated_on <= '$dateIncrementEndOfWeek'");
                                });
                            })
                            ->groupBy(['railcontent_user_content_progress.user_id', 'brand'])
                            ->get()
                            ->groupBy('user_id');

                        // active rows
                        $activeUserIds = collect(
                            DB::connection()->select(
                                "
            SELECT * FROM ((SELECT DISTINCT(user_id) as user_id FROM musora_laravel.railcontent_comments WHERE created_on >= '$dateIncrement' AND created_on <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(user_id) as user_id FROM musora_laravel.railcontent_comment_likes WHERE created_on >= '$dateIncrement' AND created_on <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(user_id) as user_id FROM musora_laravel.railcontent_content_likes WHERE created_on >= '$dateIncrement' AND created_on <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(user_id) as user_id FROM musora_laravel.railcontent_playlist_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(railcontent_user_playlists.user_id) as user_id
FROM musora_laravel.railcontent_user_playlist_content
LEFT JOIN musora_laravel.railcontent_user_playlists ON railcontent_user_playlists.id = railcontent_user_playlist_content.user_playlist_id
WHERE railcontent_user_playlist_content.created_at >= '$dateIncrement' AND railcontent_user_playlist_content.created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM drumeo_laravel.forum_posts WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM drumeo_laravel.forum_threads WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(liker_id) as user_id FROM drumeo_laravel.forum_post_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM pianote_laravel.forum_posts WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM pianote_laravel.forum_threads WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(liker_id) as user_id FROM pianote_laravel.forum_post_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM guitareo_laravel.forum_posts WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM guitareo_laravel.forum_threads WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(liker_id) as user_id FROM guitareo_laravel.forum_post_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM singeo_laravel.forum_posts WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM singeo_laravel.forum_threads WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(liker_id) as user_id FROM singeo_laravel.forum_post_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(user_id) as user_id FROM musora_laravel.railcontent_user_content_progress WHERE updated_on >= '$dateIncrement' AND updated_on <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(user_id) as user_id FROM musora_laravel.railcontent_user_content_progress WHERE started_on >= '$dateIncrement' AND started_on <= '$dateIncrementEndOfWeek' GROUP BY user_id)
) as user_e_days
WHERE user_id IN (" . implode(',', $allUserIdsInChunk->toArray()) . ")
GROUP BY user_id
            "
                            )
                        )
                            ->pluck('user_id');

//                    last_used_brand
//                    most_content_starts_brand
//                    count_of_content_starts_drumeo
//                    count_of_content_starts_pianote
//                    count_of_content_starts_guitareo
//                    count_of_content_starts_singeo
//                    count_of_content_starts_basseo
//                    count_of_content_starts_musora
//                    access_type
//                    access_frequency
//                    in_trial_period
//                    active
//                    expired
//                    generated_at
                        foreach ($userRows as $userRow) {
                            $userId = $userRow->user_id;
                            $weeklyMembershipStatsRow = [];

                            // starts and used brands
                            $userProgressRows = $usersProgressRowsGroupedByUserId[$userId] ?? [];

                            $weeklyMembershipStatsRow['last_used_brand'] = $userRow->last_used_brand ?? 'none';

                            $mostContentStartsBrand = $weeklyMembershipStatsRow['last_used_brand'];
                            $mostContentStartsCount = 0;

                            $countOfBrandContentStarts = array_combine($brands, [0, 0, 0, 0, 0, 0]);

                            foreach ($countOfBrandContentStarts as $contentStartsBrand => $contentStartsCount) {
                                $weeklyMembershipStatsRow['count_of_content_starts_' . $contentStartsBrand] = $contentStartsCount;
                            }

                            foreach ($userProgressRows ?? [] as $userProgressRow) {
                                if ($userProgressRow->count > $mostContentStartsCount) {
                                    $mostContentStartsCount = $userProgressRow->count;
                                    $mostContentStartsBrand = $userProgressRow->brand;
                                }

                                $weeklyMembershipStatsRow['count_of_content_starts_' . $userProgressRow->brand] = $userProgressRow->count;
                            }

                            $weeklyMembershipStatsRow['most_content_starts_brand'] = $mostContentStartsBrand;

                            // access type (plus or basic)
                            $weeklyMembershipStatsRow['access_type'] = 'basic';

                            foreach ($usersAccessPermissionsRowsGroupedByUserId[$userId] as $userPermissionRow) {
                                // access type (plus or basic)
                                if (str_contains(strtolower($userPermissionRow->name), 'plus')) {
                                    $weeklyMembershipStatsRow['access_type'] = 'plus';
                                    break;
                                } else {
                                    $weeklyMembershipStatsRow['access_type'] = 'basic';
                                }
                            }

                            // in trial and expired
                            $weeklyMembershipStatsRow['in_trial_period'] = false;
                            $weeklyMembershipStatsRow['expired'] = false;

                            foreach ($usersAccessPermissionsRowsGroupedByUserId[$userId] as $userPermissionRow) {
                                // in trial
                                if (!empty($userRow['trial_expiration_date'])) {
                                    $trialExpirationDate = Carbon::parse(
                                        $userRow['trial_expiration_date']
                                    );

                                    // if they are in their trial period
                                    if ($trialExpirationDate > $dateIncrement && $userPermissionRow->time_days > 0) {
                                        $weeklyMembershipStatsRow['in_trial_period'] = true;
                                    }
                                }

                                // expired
                                if (!empty($userRow['membership_expiration_date'])) {
                                    $membershipExpirationDate = Carbon::parse(
                                        $userRow['membership_expiration_date']
                                    );

                                    if ($membershipExpirationDate >= $dateIncrement &&
                                        $membershipExpirationDate <= $dateIncrementEndOfWeek) {
                                        $weeklyMembershipStatsRow['expired'] = true;
                                    }
                                }
                            }

                            // access frequency
                            $weeklyMembershipStatsRow['access_frequency'] = 'other';

                            if ($weeklyMembershipStatsRow['in_trial_period']) {
                                $weeklyMembershipStatsRow['access_frequency'] = 'trial';
                            }

                            foreach ($usersAccessPermissionsRowsGroupedByUserId[$userId] as $userPermissionRow) {
                                if (str_contains(strtolower($userPermissionRow->name), 'lifetime')) {
                                    $weeklyMembershipStatsRow['access_frequency'] = 'lifetime';
                                    continue;
                                }

                                if ($userPermissionRow->time_months == 1) {
                                    $weeklyMembershipStatsRow['access_frequency'] = 'monthly';
                                }
                                if ($userPermissionRow->time_months == 12) {
                                    $weeklyMembershipStatsRow['access_frequency'] = 'yearly';
                                }
                            }

                            // active
                            $weeklyMembershipStatsRow['active'] = false;

                            if ($activeUserIds->contains($userId)) {
                                $weeklyMembershipStatsRow['active'] = true;
                            }

                            // generated at / week / user_id
                            $weeklyMembershipStatsRow['user_id'] = $userId;
                            $weeklyMembershipStatsRow['week'] = $dateIncrement;
                            $weeklyMembershipStatsRow['generated_at'] = Carbon::now();

                            $weeklyMembershipStatsRows[] = $weeklyMembershipStatsRow;
                        }

                        $weeklyMembershipStatsRows = collect($weeklyMembershipStatsRows)->chunk(1000);

                        foreach ($weeklyMembershipStatsRows as $weeklyMembershipStatsRowsToInsert) {
                            foreach ($weeklyMembershipStatsRowsToInsert as $weeklyMembershipStatsRowToInsert) {
                                if (count($weeklyMembershipStatsRowToInsert) != 16) {
                                    dd($weeklyMembershipStatsRowToInsert);
                                }
                            }
                            WeeklyUserStatistic::query()->insert($weeklyMembershipStatsRowsToInsert->toArray());
                            $this->info("Inserted: " . count($weeklyMembershipStatsRowsToInsert));
                        }

                        $progress += count($userRows);
                        $this->info($progress);
                    }
                );

            dd(1);

            // Look through each user id

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
            SELECT * FROM ((SELECT DISTINCT(user_id) as user_id FROM musora_laravel.railcontent_comments WHERE created_on >= '$dateIncrement' AND created_on <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(user_id) as user_id FROM musora_laravel.railcontent_comment_likes WHERE created_on >= '$dateIncrement' AND created_on <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(user_id) as user_id FROM musora_laravel.railcontent_content_likes WHERE created_on >= '$dateIncrement' AND created_on <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(user_id) as user_id FROM musora_laravel.railcontent_playlist_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(railcontent_user_playlists.user_id) as user_id, d') as e_date
FROM musora_laravel.railcontent_user_playlist_content
LEFT JOIN musora_laravel.railcontent_user_playlists ON railcontent_user_playlists.id = railcontent_user_playlist_content.user_playlist_id
WHERE railcontent_user_playlist_content.created_at >= '$dateIncrement' AND railcontent_user_playlist_content.created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM drumeo_laravel.forum_posts WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM drumeo_laravel.forum_threads WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(liker_id) as user_id FROM drumeo_laravel.forum_post_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM pianote_laravel.forum_posts WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM pianote_laravel.forum_threads WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(liker_id) as user_id FROM pianote_laravel.forum_post_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM guitareo_laravel.forum_posts WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM guitareo_laravel.forum_threads WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(liker_id) as user_id FROM guitareo_laravel.forum_post_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM singeo_laravel.forum_posts WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(author_id) as user_id FROM singeo_laravel.forum_threads WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(liker_id) as user_id FROM singeo_laravel.forum_post_likes WHERE created_at >= '$dateIncrement' AND created_at <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(user_id) as user_id FROM musora_laravel.railcontent_user_content_progress WHERE updated_on >= '$dateIncrement' AND updated_on <= '$dateIncrementEndOfWeek' GROUP BY user_id)
UNION (SELECT DISTINCT(user_id) as user_id FROM musora_laravel.railcontent_user_content_progress WHERE started_on >= '$dateIncrement' AND started_on <= '$dateIncrementEndOfWeek' GROUP BY user_id)
) as user_e_days
GROUP BY user_id
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

            $dateIncrement = $dateIncrement->addWeek();
        }

        return Command::SUCCESS;
    }
}
