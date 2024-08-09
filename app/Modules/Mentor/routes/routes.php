<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Mentor\Controllers;
use Modules\Mentor\Controllers\HelpScoutMentorController;
use Modules\Mentor\Controllers\MentorController;

Route::prefix(config('mentor.route_prefix'))->middleware('web_or_api_authenticated', 'musora-center-admin')->group(function () {
        Route::get('/getMentorIdByStudent/{userId}/', [MentorController::class, 'getMentorIdByStudent']);
        Route::get('/getMentors', [MentorController::class, 'getMentors']);
        //Todo:Change to patch once musora runs on MWP domain
        Route::get('/updateStudentMentor', [MentorController::class, 'updateStudentMentor']);
        Route::get('/getMentors/{page}', [MentorController::class, 'getMentorsPaged']);
        Route::get('/getMentor/{userId}', [MentorController::class, 'getMentor']);
        Route::get('/updateMentor', [MentorController::class, 'updateMentor']);
        Route::get('/demoteMentor/{userId}', [MentorController::class, 'demoteMentor']);
    }
);

Route::prefix(config('mentor.route_prefix'))->group(function () {
        Route::post('/helpscout/conversation/new', [HelpScoutMentorController::class, 'newHelpScoutConversation'])->name('helpscout_conversation_new');
    }
);
