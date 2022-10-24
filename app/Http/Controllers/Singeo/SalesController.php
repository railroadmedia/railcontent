<?php

namespace App\Http\Controllers\Singeo;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class SalesController extends BaseController
{
    public function home()
    {
        return view('singeo.sales.standard');
    }
}
