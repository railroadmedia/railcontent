<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller 
{
    public function show(Request $request) {
        $brand = request('brand');
        $default = 'drumeo';

        return view('home.index', [
            'brand' => $brand ? $brand : $default,
        ]);
    }
}  