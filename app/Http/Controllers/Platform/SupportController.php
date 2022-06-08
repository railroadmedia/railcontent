<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Routing\Controller;

class SupportController extends Controller
{
    public function memberSupport() {

        return view('pages.support');
    }

    public function contact() {

        return view('pages.contact');
    }

}
