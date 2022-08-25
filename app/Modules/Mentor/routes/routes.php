<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Mentor\Controllers;
use Modules\Mentor\Controllers\HelpScoutMentorController;
use Modules\Mentor\Controllers\MentorController;

Route::group(
// Todo:  remove cors once musora runs on MWP domain
    ['prefix' => config('mentor.route_prefix'), 'middleware' => ['cors']],
    function () {
        Route::get('/getMentorIdByStudent/{userId}/', [MentorController::class, 'getMentorIdByStudent']);
        Route::get('/getMentors', [MentorController::class, 'getMentors']);
        //Todo:Change to patch once msuora runs on MWP domain
        Route::get('/updateStudentMentor', [MentorController::class, 'updateStudentMentor']);
        Route::get('/getMentors/{page}', [MentorController::class, 'getMentorsPaged']);
        Route::get('/getMentor/{userId}', [MentorController::class, 'getMentor']);
        Route::get('/updateMentor', [MentorController::class, 'updateMentor']);
        Route::get('/demoteMentor/{userId}', [MentorController::class, 'demoteMentor']);
        Route::post('/helpscout/conversation/new', [HelpScoutMentorController::class, 'newHelpScoutConversation']);
    }
);
