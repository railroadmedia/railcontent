# User Management System Module 

User Management System module contains the authorization functionality, user CRUD operations and user information.


## How is is set up

The configuration can be found in auth.php:

```php
    'guards' => [
        'user-management-system' => [
            'driver' => 'user-management-system',
            'provider' => 'user-management-system',
        ],
    ]
```

```php
    'providers' => [
        'user-management-system' => [
            'driver' => 'user-management-system',
            'model' => \Modules\UserManagementSystem\Models\User::class,
        ],
    ]
```

```php
    'passwords' => [
        'users' => [
            'provider' => 'user-management-system',
            'table' => 'musora_laravel.usora_password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ]
```


```php
'defaults' => [
    'guard' => 'user-management-system',
    'passwords' => 'users',
],
```
