<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Controllers\AuthenticationController;
use Modules\UserManagementSystem\Controllers\ForgotPasswordController;
use Modules\UserManagementSystem\Controllers\ResetPasswordController;
use Modules\UserManagementSystem\Controllers\UserController;

Route::group(
    ['prefix' => 'admin/reports', 'middleware' => ['web_authenticated', 'web_authenticated_admin']],
    function () {
        Route::get(
            'generate/{id}',
            \App\Modules\Reporting\Controllers\ReportController::class . '@generate',
        );
    }
);
