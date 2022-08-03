<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Mentor\Controllers;
use Modules\Mentor\Controllers\MentorController;


Route::group(
// Todo:  remove cors once musora runs on MWP domain
['prefix' => 'mentors', 'middleware' => ['cors']],
    function () {
        Route::get('/make/{userId}', [MentorController::class, 'make']);
        Route::get('/assign/{userId}/', [MentorController::class, 'assign']);
        Route::get('/getMentorIdByStudent/{userId}/', [MentorController::class, 'getMentorIdByStudent']);
        Route::get('/getMentors', [MentorController::class, 'getMentors']);
        //Todo:Change to patch once msuora runs on MWP domain
        Route::get('/updateMentor', [MentorController::class, 'updateMentor']);
    }
);


