<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request, $brand) {
        return view('home.index', [
            'brand' => $brand,
        ]);
    }
}
