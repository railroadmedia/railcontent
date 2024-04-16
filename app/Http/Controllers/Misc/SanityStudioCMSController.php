<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SanityStudioCMSController extends BaseController
{
    public function renderStudio(Request $request)
    {
        return response()->view('sanity-studio-cms.sanity-studio-cms-index');
    }
}
