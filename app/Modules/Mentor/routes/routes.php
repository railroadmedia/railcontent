<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Mentor\Controllers;
use Modules\Mentor\Controllers\MentorController;


Route::group(
    ['prefix' => 'mentors'],
    function () {
        Route::get('/make/{userId}', [MentorController::class, 'make']);
        Route::get('/assign/{userId}/', [MentorController::class, 'assign']);
    }
);


