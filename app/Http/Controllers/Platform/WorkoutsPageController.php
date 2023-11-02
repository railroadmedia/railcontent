<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class WorkoutsPageController extends BaseController
{
    public function showWorkoutsPage(Request $request)
    {
        return view('pages.workouts');
    }
}