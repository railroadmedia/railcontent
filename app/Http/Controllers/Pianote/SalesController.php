<?php

namespace App\Http\Controllers\Pianote;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class HomePageController extends BaseController
{
    public function home()
    {
        return view('pianote.sales.standard');
    }
}
