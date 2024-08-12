<?php

return [

    'guards' => [
        'user-management-system' => [
            'driver' => 'user-management-system',
            'provider' => 'user-management-system',
        ],
    ],

    'providers' => [
            'user-management-system' => [
                'driver' => 'user-management-system',
                'model' => \Modules\UserManagementSystem\Models\User::class,
            ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'user-management-system',
            'table' => 'usora_password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

];
