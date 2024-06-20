<?php

namespace App\Console\Commands;

use App\Models\WeeklyUserStatistic;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
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
    // DO NOT CALCULATE THE CURRENT WEEK, that can cause data anomalies.
    protected $signature = 'generate:weekly_statistics {startDate?} {endDate?} {chunkSize?}';
    // r mwp artisan generate:weekly_statistics "2024-05-01" "2024-05-01"

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates weekly stats rows for all days between passed in dates including the start and end period weeks.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info(
            "*** DO NOT calculate and save the current week, that can throw off the data. Always calculate starting at least 1 week in to the past. ***"
        );

        // Reporting is always Monday 00:00:00 -> Sunday 23:59:59
        $startDate = $this->argument('startDate');
        $endDate = $this->argument('endDate');

        // Default to generating the last 2 weeks of data
        $startDate = !empty($startDate) ?
            Carbon::parse($startDate)->startOfWeek(1) : Carbon::now()->startOfWeek(1)->subWeek();
        $endDate = !empty($endDate) ? Carbon::parse($endDate)->endOfWeek(1) : Carbon::now()->endOfWeek(1)->subWeek();

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

            $progress = 0;

            // clear the week first
            WeeklyUserStatistic::query()->where('week', $dateIncrement)->delete();

            // Get all users with permissions and get all their permissions
            DB::connection('musora_laravel_mysql')
                ->table('usora_users')
                ->select(
                    [
                        'usora_users.id as user_id',
                        'trial_expiration_date',
                        'last_used_brand',
                        'membership_expiration_date',
                    ]
                )
                ->leftJoin('user_access_permissions', function (JoinClause $joinClause) use ($allMembershipPermissionIds) {
                    $joinClause->on('usora_users.id', '=', 'user_access_permissions.user_id')
                        ->whereIn('user_access_permissions.permission_id', $allMembershipPermissionIds);
                })
                ->where(
                    function (Builder $query) use (
                        $dateIncrementEndOfWeek,
                        $dateIncrement,
                        $startDate,
                        $endDate
                    ) {
                        $query->where(function (Builder $query) use ($dateIncrement, $startDate, $endDate) {
                            $query->whereRaw("'$dateIncrement' >= start_time")
                                ->whereRaw("'$dateIncrement' <= end_time");
                        })->orWhere(function (Builder $query) use ($dateIncrementEndOfWeek, $dateIncrement) {
                            $query->where('membership_expiration_date', '>=', $dateIncrement)
                                ->where('membership_expiration_date', '<=', $dateIncrementEndOfWeek);
                        });
                    }
                )
//                ->where(function ($query) use ($dateIncrementEndOfWeek, $dateIncrement) {
//                    $query->where('membership_expiration_date', '>', $dateIncrement);
//                    $query->where('membership_expiration_date', '<', $dateIncrementEndOfWeek);
//                })
//                ->where(function ($query) use ($dateIncrement) {
//                    $query->where('trial_expiration_date', '<', $dateIncrement)
//                        ->orWhereNull('trial_expiration_date');
//                })
                ->orderBy('usora_users.id', 'desc')
                ->groupBy('usora_users.id')
                ->chunk(
                    $this->argument('chunkSize') ?? 1000,
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

                        $printQuery = DB::connection('musora_laravel_mysql')
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
                            ->groupBy(['railcontent_user_content_progress.user_id', 'brand']);

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

                        // Rows to save:
                        // last_used_brand
                        // most_content_starts_brand
                        // count_of_content_starts_drumeo
                        // count_of_content_starts_pianote
                        // count_of_content_starts_guitareo
                        // count_of_content_starts_singeo
                        // count_of_content_starts_basseo
                        // count_of_content_starts_musora
                        // access_type
                        // access_frequency
                        // in_trial_period
                        // active
                        // expired
                        // generated_at

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

                            foreach ($usersAccessPermissionsRowsGroupedByUserId[$userId] ?? [] as $userPermissionRow) {
                                // access type (plus or basic)
                                if (str_contains(strtolower($userPermissionRow->name), 'plus')) {
                                    $weeklyMembershipStatsRow['access_type'] = 'plus';
                                    break;
                                } else {
                                    $weeklyMembershipStatsRow['access_type'] = 'basic';
                                }
                            }

                            // in trial
                            $weeklyMembershipStatsRow['in_trial_period'] = false;
                            $weeklyMembershipStatsRow['expired'] = false;

                            foreach ($usersAccessPermissionsRowsGroupedByUserId[$userId] ?? [] as $userPermissionRow) {
                                // in trial
                                if (!empty($userRow->trial_expiration_date)) {
                                    $trialExpirationDate = Carbon::parse(
                                        $userRow->trial_expiration_date
                                    );

                                    // if they are in their trial period
                                    if ($trialExpirationDate > $dateIncrement && $userPermissionRow->time_days > 0) {
                                        $weeklyMembershipStatsRow['in_trial_period'] = true;
                                    }
                                }
                            }

                            // is expired
                            if (!empty($userRow->membership_expiration_date)) {
                                $membershipExpirationDate = Carbon::parse(
                                    $userRow->membership_expiration_date
                                );

                                if ($membershipExpirationDate >= $dateIncrement &&
                                    $membershipExpirationDate <= $dateIncrementEndOfWeek) {
                                    $weeklyMembershipStatsRow['expired'] = true;
                                }
                            }

                            // access frequency
                            $weeklyMembershipStatsRow['access_frequency'] = 'other';

                            if ($weeklyMembershipStatsRow['in_trial_period']) {
                                $weeklyMembershipStatsRow['access_frequency'] = 'trial';
                            }

                            foreach ($usersAccessPermissionsRowsGroupedByUserId[$userId] ?? [] as $userPermissionRow) {
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

            $dateIncrement = $dateIncrement->addWeek();
        }

        return Command::SUCCESS;
    }
}
