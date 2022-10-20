<?php

namespace App\Http\Controllers\Guitareo;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class SalesController extends BaseController
{
    public function show()
    {
        return view('guitareo.sales.standard');
    }
}
