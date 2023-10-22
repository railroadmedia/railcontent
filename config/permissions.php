<?php

// IMPORTANT NOTICE: this is only for the legacy rail permissions package.
return [
    'cache_duration' => 60 * 60 * 24 * 30,
    'cache_driver' => 'array',

    'database_connection_name' => env('DB_DEFAULT_CONNECTION_NAME','musora_laravel_mysql'),
    'database_mode' => 'host',

    'table_prefix' => 'permissions_',
    'tables' => [
        'user_abilities' => 'user_abilities',
        'user_roles' => 'user_roles',
    ],

    'role_abilities' => [
        'administrator' => [
            'like-posts',
            'index-posts',
            'show-posts',
            'create-posts',
            'update-posts' => ['only' => ['content', 'thread_id', 'created_at']],
            'delete-posts',
            'read-threads',
            'follow-threads',
            'create-threads',
            'update-threads' => ['only' => ['title', 'category_id', 'created_at', 'locked', 'pinned']],
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
            'update-discussions' => ['only' => ['title', 'topic', 'description','icon']],
            'delete-discussions',

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
            'update-posts' => ['only' => ['content', 'thread_id']],
            'delete-posts',
            'read-threads',
            'follow-threads',
            'create-threads',
            'update-threads' => ['only' => ['title', 'category_id', 'created_at', 'locked', 'pinned']],
            'delete-threads',
            'report-posts',
            'chat.ban_user',
            'chat.unban_user',
            'chat.delete_user_messages',
            'index-threads',
            'index-discussions',
            'show-discussions',
            'create-discussions',
            'update-discussions' => ['only' => ['title', 'topic', 'description','icon']],
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
        // roles for musora center
        'shipping_fulfillment' => [
            'pull.fulfillments',
            'fulfilled.fulfillment',
            'delete.fulfillment',
            'upload.fulfillments',
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
        'role2' => [
            'ability-2',
            'ability-3',
        ],
    ],
];
