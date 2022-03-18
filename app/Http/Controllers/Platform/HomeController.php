<?php

namespace App\Http\Controllers\Platform;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller 
{
    public function show(Request $request) {
        if ($request->has('brand')) {
            $brand = $request->input('brand');
        }
        return view('home.index', [
            'brand' => $brand,
        ]);
    }
}  