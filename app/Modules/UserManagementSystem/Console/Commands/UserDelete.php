<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoDeleteUser;
use Illuminate\Database\DatabaseManager;

class UserDelete extends Command
{
    protected $signature = 'user:delete {--execute}';
    protected $description = 'Completely remove a user from the database.';

    private $simulate = false;
    private DatabaseManager $databaseManager;

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
                'onboarding_gears',
                'onboarding_genres',
                'onboarding_topics',
                'railtracker_content_last_engaged',
                'railtracker_content_last_engaged_seconds'
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
                'railtracker4_requests',
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
                'railtracker4_requests',
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
                'railtracker4_requests',
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
                'railtracker4_requests',
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

    public function handle(DatabaseManager $databaseManager): void
    {
        $this->simulate = $this->option('execute') == false;
        if ($this->simulate) {
            $this->info(
                "Executing in simulation mode. No changes will be made to the database.  Use --execute to run for real."
            );
        }
        $this->databaseManager = $databaseManager;
        $this->withExecutionTime(function () {
            $connection = $this->databaseManager->connection(config('usora.database_connection_name'));

            $usersToDelete = $connection->table('usora_users')
                ->select(['usora_users.id', 'usora_users.email'])
                ->join('ecommerce_subscriptions', 'ecommerce_subscriptions.user_id', '=', 'usora_users.id')
                ->where(function ($query) {
                    $query->whereRaw($this->databaseManager->raw('last_used_brand is null or email LIKE "%data%"'));
                })
                ->where('ecommerce_subscriptions.product_id', '=', 488)
                ->orderBy('usora_users.id', 'desc')
                ->get();

            $count = $usersToDelete->count();
            $this->info('Found ' . $count . ' users to delete');

            // check if they have any successful payments first
            foreach ($usersToDelete as $userToDeleteIndex => $userToDelete) {
                $payments = $connection->table('ecommerce_payments')
                    ->leftJoin(
                        'ecommerce_payment_methods',
                        'ecommerce_payment_methods.id',
                        '=',
                        'ecommerce_payments.payment_method_id'
                    )
                    ->leftJoin(
                        'ecommerce_user_payment_methods',
                        'ecommerce_user_payment_methods.payment_method_id',
                        '=',
                        'ecommerce_payment_methods.id'
                    )
                    ->where('ecommerce_user_payment_methods.user_id', $userToDelete->id)
                    ->get();

                foreach ($payments as $payment) {
                    if ($payment->total_paid > 0) {
                        $this->info(
                            'Warning, user ID: ' . $userToDelete->id . ' had a successful payment. Skipping...'
                        );
                        unset($usersToDelete[$userToDeleteIndex]);
                    }
                }
            }

            $this->deleteUserIds($usersToDelete->pluck('id')->toArray());
        });
    }

    public function deleteUserIds(array $allUserIds)
    {
        foreach ($allUserIds as $userId) {
            if ($this->simulate) {
                $this->info("Simulating delete user $userId from customer IO");
            } else {
                $this->info("Deleting user from customer IO: $userId");
                dispatch_sync(new CustomerIoDeleteUser($userId));
            }
        }

        $totalRowsDeleted = 0;
        $batch = array_chunk($allUserIds, 1000);

        foreach ($batch as $batchIndex => $batchUserIds) {
            foreach ($this->databaseTablesUserIdColumnsMap as $databaseConnectionName => $tablesColumns) {
                foreach ($tablesColumns as $userIdColumn => $tableNames) {
                    foreach ($tableNames as $tableName) {
                        $query = $this->databaseManager->connection($databaseConnectionName)->table($tableName);

                        $query->orWhereIn($userIdColumn, $batchUserIds);


                        if ($this->simulate) {
                            $rows = $query->get();
                            $totalRowsDeleted += $rows->count();

                            foreach ($rows as $row) {
                                $this->info(
                                    "Deleting (simulate): $tableName id: $row->id $userIdColumn:" . $row->{$userIdColumn}
                                );
                            }
                        } else {
                            $this->info('Deleting from table: ' . $tableName);

                            $totalRowsDeleted += $query->delete();

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
                $totalRowsDeleted += $userRows->count();
                foreach ($userRows as $userRow) {
                    $this->info("Deleting (simulate): usora_users id: $userRow->id email: $userRow->email");
                }
            } else {
                $totalRowsDeleted += $query->delete();
            }

            $this->info('Finished batch ' . $batchIndex + 1 . ' out of ' . count($batch));
            $this->info('Total rows deleted: ' . $totalRowsDeleted);
            $this->info('Total users deleted: ' . count($allUserIds));
        }
    }
}
