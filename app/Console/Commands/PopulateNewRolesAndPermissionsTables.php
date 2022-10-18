<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PopulateNewRolesAndPermissionsTables extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'PopulateNewRolesAndPermissionsTables';

    protected $signature = 'PopulateNewRolesAndPermissionsTables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate roles and permissions from all brands config/permissions files to bd tables';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        print_r("##### PopulateNewRolesAndPermissionsTables command starts now ######\n");

        $permissions =
            [
                'administrator' => [
                    'like-posts',
                    'index-posts',
                    'show-posts',
                    'create-posts',
                    'update-posts',
                    'delete-posts',
                    'read-threads',
                    'follow-threads',
                    'create-threads',
                    'update-threads',
                    'delete-threads',
                    'report-posts',
                    'index-users',
                    'chat.ban_user',
                    'chat.unban_user',
                    'chat.delete_user_messages',
                    'index-threads',
                    'index-discussions',
                    'show-discussions',
                    'create-discussions',
                    'update-discussions',
                    'delete-discussions',
                    'index-users',
                    'show-users',
                    'update-users',
                    'create-users',
                    'pull.customers',
                    'update.customers',
                    'create.payment_gateway',
                    'edit.payment_gateway',
                    'delete.payment_gateway',
                    'create.shipping.option',
                    'edit.shipping.option',
                    'delete.shipping.option',
                    'pull.shipping.options',
                    'create.payment.method',
                    'update.payment.method',
                    'delete.payment.method',
                    'list.payment',
                    'create.payment',
                    'delete.payment',
                    'pull.user.payment.method',
                    'pull.customer.payment.method',
                    'pull.orders',
                    'edit.order',
                    'delete.order',
                    'pull.subscriptions',
                    'edit.subscription',
                    'delete.subscription',
                    'create.subscription',
                    'renew.subscription',
                    'pull.discounts',
                    'pull.contents',
                    'pull.fulfillments',
                    'fulfilled.fulfillment',
                    'delete.fulfillment',
                    'upload.fulfillments',
                    'pull.user.payment.method',
                    'delete.payment.method',
                    'list.payment',
                    'store.refund',
                    'pull.discounts',
                    'create.discount',
                    'update.discount',
                    'delete.discount',
                    'create.discount.criteria',
                    'update.discount.criteria',
                    'delete.discount.criteria',
                    'pull.permissions',
                    'edit.permissions',
                    'create.product',
                    'update.product',
                    'delete.product',
                    'pull.inactive.products',
                    'create.shipping_cost',
                    'edit.shipping_cost',
                    'delete.shipping_cost',
                    'pull.access_codes',
                    'claim.access_codes',
                    'release.access_codes',
                    'create.content.hierarchy',
                    'create.content.field',
                    'delete.content.field',
                    'create.content.data',
                    'delete.content.data',
                    'update.content',
                    'assign.permission',
                    'disociate.permission',
                    'pull.addresses',
                    'store.address',
                    'update.address',
                    'place-orders-for-other-users',
                    'pull.user-products',
                    'create.user-products',
                    'update.user-products',
                    'delete.user-products',
                    'pull.daily-statistics',
                    'update-users-email-without-confirmation',
                    'show_deleted',
                    'pull.failed-subscriptions',
                    'pull.failed-billing',
                    'pull.accounting',
                    'send_payment_invoice',
                    'pull.membership-stats',
                    'pull.retention-stats',
                    'pull.membership-actions',
                ],
                'moderator' => [
                    'like-posts',
                    'index-posts',
                    'show-posts',
                    'create-posts',
                    'update-posts',
                    'delete-posts',
                    'read-threads',
                    'follow-threads',
                    'create-threads',
                    'update-threads',
                    'delete-threads',
                    'report-posts',
                    'chat.ban_user',
                    'chat.unban_user',
                    'chat.delete_user_messages',
                    'index-threads',
                    'index-discussions',
                    'show-discussions',
                    'create-discussions',
                    'update-discussions',
                    'delete-discussions',
                ],
                'user' => [
                    'like-posts',
                    'index-posts',
                    'show-posts',
                    'create-posts',
                    'read-threads',
                    'follow-threads',
                    'create-threads',
                    'report-posts',
                    'index-threads',
                    'index-discussions',
                    'show-discussions',
                    'create-discussions'
                ],
                'live_chat_moderator' => [
                    'chat.ban_user',
                    'chat.unban_user',
                    'chat.delete_user_messages',
                ],
                'shipping_fulfillment' => [
                    'pull.fulfillments',
                    'fulfilled.fulfillment',
                    'delete.fulfillment',
                    'upload.fulfillments',
                    'upload.fulfillments',
                    'shipping-fulfillment'
                ],
                'payment_recovery' => [
                    'index-users',
                    'show-users',
                    'update-users',
                    'create-users',
                    'create.payment.method',
                    'update.payment.method',
                    'delete.payment.method',
                    'list.payment',
                    'create.payment',
                    'delete.payment',
                    'pull.user.payment.method',
                    'pull.orders',
                    'edit.order',
                    'delete.order',
                    'pull.subscriptions',
                    'edit.subscription',
                    'delete.subscription',
                    'create.subscription',
                    'renew.subscription',
                    'pull.user.payment.method',
                    'delete.payment.method',
                    'list.payment',
                    'store.refund',
                    'pull.addresses',
                    'store.address',
                    'update.address',
                    'place-orders-for-other-users',
                    'pull.user-products',
                    'create.user-products',
                    'update.user-products',
                    'delete.user-products',
                    'show_deleted',
                    'pull.failed-subscriptions',
                    'pull.failed-billing',
                    'send_payment_invoice',
                    'pull.membership-actions',
                ],
                'view_daily_stats' => ['daily-stats'],
                'accounting' => ['accounting-reporting'],
                'membership_stats' => ['membership_stats'],
                'retention_stats' => ['retention-stats'],
                'it' => ['it'],
                'login_as_users' => ['login_as_users'],
            ];

        $roles = [
            'administrator',
            'super_administrator',
            'user',
            'moderator',
            'live_chat_moderator',
            'shipping_fulfillment',
            'payment_recovery',
            'view_daily_stats',
            'accounting',
            'membership_stats',
            'retention_stats',
            'it',
            'login_as_users',
        ];

        foreach ($roles as $role) {
            $newRole = Role::findOrCreate($role);
            if (array_key_exists($role, $permissions)) {
                foreach ($permissions[$role] as $permissionOfRole) {
                    Permission::findOrCreate($permissionOfRole);
                    $newRole->givePermissionTo($permissionOfRole);
                }
            } else {
                print_r("Role " . $role . " has not been found in the role_permissions list. \n");
            }
        }

        print_r("The new roles and permissions have been created. \n");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
