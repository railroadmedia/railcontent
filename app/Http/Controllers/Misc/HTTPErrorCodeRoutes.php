<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class HTTPErrorCodeRoutes extends BaseController
{
    public function notFound404(Request $request)
    {
        return response()->view('errors.404', [], 404);
    }
}
