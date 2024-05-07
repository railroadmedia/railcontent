<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoDeleteUser;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserDelete extends Command
{
    protected $signature = 'user:delete
                            {--startingId= : (Optional) The user Id to start processing at}
                            {--limit= : (Optional) The number of users to limit this run to.}
                            {--execute : Execute the deletion from the database. Without this flag, it will be simulated. }';

    protected $description = 'Completely remove a user from the database.';

    private bool $simulate = false;
    private int $totalRowsDeleted = 0;
    private int $totalUsersDeleted = 0;
    private Collection $deletedUserIds;
    private DatabaseManager $databaseManager;

    // Should review this query for future use
    // SELECT * FROM information_schema.columns WHERE column_name = 'user_id'
    private $databaseTablesUserIdColumnsMap = [
        // musora_laravel
        'musora_laravel_mysql_writer_only' => [
            'user_id' => [
                'ecommerce_addresses',
                'ecommerce_orders',
                'ecommerce_subscriptions',
                'ecommerce_user_payment_methods',
                'ecommerce_user_products',
                'ecommerce_user_stripe_customer_ids',
                'points_user_points',
                'railcontent_comments',
                'railcontent_comment_assignment',
                'railcontent_comment_likes',
                'railcontent_content',
                'railcontent_content_likes',
                'railcontent_user_content_progress',
                'railcontent_user_permissions',
                'railcontent_user_playlists',
                'railtracker4_requests',
                'railtracker_media_playback_sessions',
                'user_abilities',
                'user_roles',
                'usora_email_changes',
                'usora_remember_tokens',
                'usora_user_fields',
                'usora_user_firebase_tokens',
                'mentor_students',
                'onboarding_answer_history',
                'onboarding_experience',
                'onboarding_goals',
                'onboarding_gears',
                'onboarding_genres',
                'onboarding_topics',
                'railtracker_content_last_engaged',
                'railtracker_content_last_engaged_seconds',
                'customer_io_customers'
            ],
            'author_id' => [
                'railcontent_versions',
                'forum_threads',
                'forum_posts',
            ],
            'claimer_id' => [
                'ecommerce_access_codes',
            ],
            'placed_by_user_id' => [
                'ecommerce_orders',
            ],
            'liker_id' => [
                'forum_post_likes',
            ],
            'reporter_id' => [
                'forum_post_reports',
            ],
            'follower_id' => [
                'forum_thread_follows',
            ],
            'reader_id' => [
                'forum_thread_reads',
            ],
            'recipient_id' => [
                'notifications',
            ],
            'actor_id' => [
                'railactionlog_actions_log',
            ],
        ],

        // drumeo_laravel
        'drumeo_laravel_mysql_writer_only' => [
            'user_id' => [
                'apple_receipts',
                'email_history',
                'google_receipts',
                'membership_actions',
                'members_area_events',
                'railcenter_email_history',
                'railcenter_order_account',
                'railcenter_renewal_history_inf_ppal',
                'railcenter_user_levels',
                'railcenter_user_level_links',
                'railtracker_media_playback_sessions',
                'star_rating',
                'subscriptions',
                'user_notifications',
                'user_orders',
                'user_payment_methods',
                'user_profile_data',
                'user_shipping_addresses',
                'user_stripe_customer',
                'user_video_timings'
            ],
            'author_id' => [
                'forum_posts',
                'forum_threads',
            ],
            'liker_id' => [
                'forum_post_likes',
            ],
            'reporter_id' => [
                'forum_post_reports',
            ],
            'follower_id' => [
                'forum_thread_follows',
            ],
            'reader_id' => [
                'forum_thread_reads',
            ],
            'userId' => [
                'answers',
                'beta_keys',
                'teachers',
            ],
            'claimed_by_user_id' => [
                'railcenter_action_codes',
            ],
            'usora_id' => [
                'users',
            ],
        ],

        // guitareo_laravel
        'guitareo_laravel_mysql_writer_only' => [
            'user_id' => [
                'achievement_history',
                'achievement_user',
                'bookmarked_series',
                'cards',
                'completed_lessons',
                'experiences',
                'favourite_series',
                'railtracker_media_playback_sessions',
                'role_user',
                'shipping_addresses',
                'subscriptions',
                'tag_history',
                'tag_user',
                'transactions',
                'user_messages',
                'user_plans',
                'watched_broadcasts',
                'watched_lessons',
            ],
            'author_id' => [
                'forum_posts',
                'forum_threads',
            ],
            'liker_id' => [
                'forum_post_likes',
            ],
            'reporter_id' => [
                'forum_post_reports',
            ],
            'follower_id' => [
                'forum_thread_follows',
            ],
            'reader_id' => [
                'forum_thread_reads',
            ],
            'added_by_id' => [
                'achievement_history',
            ],
        ],

        // pianote_laravel
        'pianote_laravel_mysql_writer_only' => [
            'user_id' => [
                'railtracker_media_playback_sessions',
                'subscriptions',
                'user_access_levels',
                'user_addresses',
                'user_comments',
                'user_content_progression',
                'user_fields',
                'user_payment_methods',
                'user_stripe_customer_ids',
                'user_video_sessions',
            ],
            'author_id' => [
                'articles',
                'forum_posts',
                'forum_threads',
            ],
            'created_by_user_id' => [
                'content',
            ],
            'liker_id' => [
                'forum_post_likes',
            ],
            'reporter_id' => [
                'forum_post_reports',
            ],
            'follower_id' => [
                'forum_thread_follows',
            ],
            'reader_id' => [
                'forum_thread_reads',
            ],
            'recipient_id' => [
                'notifications',
            ],
            'owner_id' => [
                'settings',
            ],
        ],

        // pianote_laravel
        'singeo_laravel_mysql_writer_only' => [
            'user_id' => [
                'railtracker_media_playback_sessions',
            ],
            'author_id' => [
                'forum_posts',
                'forum_threads',
            ],

            'liker_id' => [
                'forum_post_likes',
            ],
            'reporter_id' => [
                'forum_post_reports',
            ],
            'follower_id' => [
                'forum_thread_follows',
            ],
            'reader_id' => [
                'forum_thread_reads',
            ],
            'owner_id' => [
                'settings',
            ],
        ],
    ];

    /**
     * Execute the command
     *
     * @param DatabaseManager $databaseManager
     * @return void
     */
    public function handle(DatabaseManager $databaseManager): void
    {
        $this->deletedUserIds = collect();
        $this->simulate = $this->option('execute') == false;
        if ($this->simulate) {
            $this->info(
                "Executing in simulation mode. No changes will be made to the database.  Use --execute to run for real."
            );
        }
        $startingId = $this->option("startingId");
        $limit = $this->option("limit");

        $this->databaseManager = $databaseManager;
        $this->withExecutionTime(function () use ($limit, $startingId) {
            $connection = $this->databaseManager->connection(config('usora.database_connection_name'));

            $usersToDelete = $connection->table('usora_users')
                ->select(['usora_users.id', 'usora_users.email'])
                ->join('ecommerce_subscriptions', 'ecommerce_subscriptions.user_id', '=', 'usora_users.id')
                ->join('ecommerce_products', 'ecommerce_products.id', '=', 'ecommerce_subscriptions.product_id')
                ->where(function (Builder $query) {
                    $query->whereRaw($this->databaseManager->raw('last_used_brand is null or email LIKE "%data%"'));
                })
                ->whereNotExists(function (Builder $query) {
                    $query->select($this->databaseManager->raw(1))
                        ->from('ecommerce_payments')
                        ->join(
                            'ecommerce_payment_methods',
                            'ecommerce_payment_methods.id',
                            '=',
                            'ecommerce_payments.payment_method_id'
                        )
                        ->join(
                            'ecommerce_user_payment_methods',
                            'ecommerce_user_payment_methods.payment_method_id',
                            '=',
                            'ecommerce_payments.id'
                        )
                        ->whereColumn('ecommerce_user_payment_methods.user_id', '=', 'usora_users.id')
                        ->where('ecommerce_payments.total_paid', '>', 0);
                })
                ->whereNotExists(function (Builder $query) {
                    $query->select($this->databaseManager->raw(1))
                        ->from('ecommerce_payments')
                        ->join(
                            'ecommerce_subscription_payments',
                            'ecommerce_subscription_payments.payment_id',
                            '=',
                            'ecommerce_payments.id'
                        )
                        ->join(
                            'ecommerce_subscriptions',
                            'ecommerce_subscriptions.id',
                            '=',
                            'ecommerce_subscription_payments.subscription_id'
                        )
                        ->whereColumn('ecommerce_subscriptions.user_id', '=', 'usora_users.id')
                        ->where('ecommerce_payments.total_paid', '>', 0);
                })
                ->where('ecommerce_products.sku', "like", "%trial%")
                // last_used_brand was only added for unified launch in dec 2022, so restricting it to only delete users after that
                ->where('usora_users.created_at', '>', '2023-01-01')
                ->orderBy('usora_users.id', 'desc')
                ->when(!is_null($startingId), function (Builder $q) use ($startingId) {
                    return $q->where('usora_users.id', '>=', $startingId);
                })
                // users could actively be on a free trial right now, make sure they are expired
                ->whereDate('usora_users.membership_expiration_date', '<', Carbon::today())
                ->groupBy('usora_users.id');

            // because of the groupBy, we can't get the count unless we get the results, which defeats the purpose of
            // chunking, so we'll use the trick from pratimroy1990 in https://laracasts.com/discuss/channels/eloquent/eloquent-groupby-count-always-returns-1
            $count = DB::table(DB::raw("({$usersToDelete->toSql()}) as query"))->mergeBindings($usersToDelete)->count();


            // chunk doesn't use a limit set in the query, so we'll work around that by keeping track of the count internally
            $userCount = !is_null($limit) ? min($limit, $count) : $count;
            $batchSize = 10;
            $this->info('Found ' . $count . ' users to delete');
            if ($limit && $userCount < $count) {
                $limitInfo = 'Limiting to ' . $userCount;
                // chunkById grabs the paginated IDs, so we can't break out of the loop if we have a smaller
                // amount wanted inside the batch, so we'll just tell the user that it got increased
                if ($userCount % $batchSize) {
                    $batchedLimit = intval($userCount * ceil($batchSize / $userCount));
                    $limitInfo .= ', rounded up to ' . $batchedLimit . ' for batching.';
                }
                $this->info($limitInfo);
            }

            $isAtLimit = false;
            $tally = 0;
            $batchIndex = 0;
            $batchTotal = ceil($userCount / $batchSize);

            $usersToDelete->chunkById($batchSize, function (Collection $userDataChunk) use (
                $userCount,
                $batchSize,
                &$isAtLimit,
                &$tally,
                &$batchIndex,
                $batchTotal
            ) {
                // do the internal limit tracking
                if ($isAtLimit) {
                    return false;
                }
                $tally += $batchSize;
                $remaining = $userCount - $tally;
                if ($remaining <= 0) {
                    $isAtLimit = true;
                }
                ++$batchIndex;

                $userIds = $userDataChunk->pluck("id")->toArray();
                $this->deleteFromCustomerIo($userIds);
                $this->deleteFromDatabase($userIds, $batchIndex, $batchTotal);

                $this->deletedUserIds = $this->deletedUserIds->push(...$userIds);
            }, 'usora_users.id', 'id');
        });

        $this->info('Deleting users: ' . $this->deletedUserIds->implode(', '));
    }

    /**
     * Delete the users from CustomerIO, using their provided IDs
     *
     * @param array $userIds
     * @return void
     */
    protected function deleteFromCustomerIo(array $userIds): void
    {
        foreach ($userIds as $userId) {
            if ($this->simulate) {
                $this->info("Simulating delete user $userId from customer IO");
            } else {
                $this->info("Deleting user from customer IO: $userId");
                dispatch_sync(new CustomerIoDeleteUser($userId));
            }
        }
    }

    /**
     * Delete the users from all our defined tables, using their provided IDs
     *
     * @param array $batchUserIds
     * @param int $batchIndex
     * @param int $batchTotal
     * @return void
     */
    protected function deleteFromDatabase(array $batchUserIds, int $batchIndex, int $batchTotal): void
    {
        try {
            foreach ($this->databaseTablesUserIdColumnsMap as $databaseConnectionName => $tablesColumns) {
                foreach ($tablesColumns as $userIdColumn => $tableNames) {
                    foreach ($tableNames as $tableName) {
                        $query = $this->databaseManager
                            ->connection($databaseConnectionName)
                            ->table($tableName)
                            ->whereIn($userIdColumn, $batchUserIds);

                        if ($this->simulate) {
                            $rows = $query->get();
                            $this->totalRowsDeleted += $rows->count();

                            foreach ($rows as $row) {
                                $id = property_exists($row, 'id') ? $row->id : '';
                                $this->info(
                                    "Deleting (simulate): $databaseConnectionName.$tableName id: $id $userIdColumn:" . $row->{$userIdColumn}
                                );
                            }
                        } else {
                            $this->info("Deleting from table: $databaseConnectionName.$tableName");

                            $this->totalRowsDeleted += $query->delete();

                            usleep(100000);
                        }
                    }
                }
            }

            // finally delete from the usora users table
            $query = $this->databaseManager->connection('musora_laravel_mysql_writer_only')->table(
                'usora_users'
            )->WhereIn('id', $batchUserIds);

            if ($this->simulate) {
                $userRows = $query->get();
                $this->totalRowsDeleted += $userRows->count();
                foreach ($userRows as $userRow) {
                    $this->info("Deleting (simulate): usora_users id: $userRow->id email: $userRow->email");
                }
            } else {
                $this->totalRowsDeleted += $query->delete();
            }

            $this->totalUsersDeleted += count($batchUserIds);
            $this->info('Finished batch ' . $batchIndex . ' out of ' . $batchTotal);
            $this->info('Total rows deleted: ' . $this->totalRowsDeleted);
            $this->info('Total users deleted: ' . $this->totalUsersDeleted);
        } catch (\Exception $e) {
            $this->info("Error deleting users: " . implode(', ', $batchUserIds));
            Log::error($e);
        }
    }
}
